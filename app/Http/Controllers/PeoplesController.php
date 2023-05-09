<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Models\People;
use App\Models\Film;
use App\Models\Starship;
use App\Exports\PeoplesExport;
use Maatwebsite\Excel\Facades\Excel;
use Yoeunes\Toastr\Toastr;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\PeopleUpdated;
use App\Events\RecordUpdated;
use Illuminate\Support\Facades\Log;
use \Notion;
use FiveamCode\LaravelNotionApi\Entities\Page;
use FiveamCode\LaravelNotionApi\Entities\Database;
use FiveamCode\LaravelNotionApi\Entities\Properties\Title;
use FiveamCode\LaravelNotionApi\Entities\Properties\Text;
use FiveamCode\LaravelNotionApi\Entities\Properties\Number;
use FiveamCode\LaravelNotionApi\Entities\Properties\Date;
use FiveamCode\LaravelNotionApi\Entities\PropertyItems\RichText;

class PeoplesController extends Controller
{
    protected $activityLogsController;

    public function __construct(ActivityLogsController $activityLogsController)
    {
        $this->activityLogsController = $activityLogsController;
    }

    public function default()
    {
        $cacheKey = 'allPeopleData';

        // check if the data is cached
        if (cache()->has($cacheKey)) {
            $allPeopleData = cache()->get($cacheKey);
        } else {
            $allPeopleData = [];

            // fetch data from the first page
            $peopleData = Http::get('https://swapi.dev/api/people/')->json();

            // append the result into the $allpeopledata array
            $allPeopleData = array_merge($allPeopleData, $peopleData['results']);

            // check if there is any more pages
            while ($peopleData['next']) {
                $peopleData = Http::get($peopleData['next'])->json();
                $allPeopleData = array_merge($allPeopleData, $peopleData['results']);
            }

            // cache the data for 1 day
            cache()->put($cacheKey, $allPeopleData, now()->addDay(1));
        }

        // log info
        $this->activityLogsController->log('Peoples', 'Fetch');

        return view('peoples', ['allPeopleData' => $allPeopleData]);
    }

    public function store()
    {
        $page = 1;
        do {
            $response = Http::get('https://swapi.dev/api/people/', ['page' => $page]);
            $data = $response->json();
            $peoples = $data['results'];

            foreach ($peoples as $people) {
                // prevent character duplication
                $existingPeople = People::where('name', $people['name'])->first();
                if (!$existingPeople) {
                    // convert films, species, vehicles, starships  arrays to JSON
                    $filmsJson = json_encode($people['films']);
                    $speciesJson = json_encode($people['species']);
                    $vehiclesJson = json_encode($people['vehicles']);
                    $starshipsJson = json_encode($people['starships']);
                    // save the character data to the database
                    $newPeople = new People;
                    $newPeople->name = ucwords($people['name']);
                    $newPeople->height = $people['height'];
                    $newPeople->mass = $people['mass'];
                    $newPeople->hair_color = ucwords($people['hair_color']);
                    $newPeople->skin_color = ucwords($people['skin_color']);
                    $newPeople->eye_color = ucwords($people['eye_color']);
                    $newPeople->birth_year = $people['birth_year'];
                    $newPeople->gender = ucwords($people['gender']);
                    $newPeople->homeworld = ucwords($people['homeworld']);
                    $newPeople->films = $filmsJson;
                    $newPeople->species = $speciesJson;
                    $newPeople->vehicles = $vehiclesJson;
                    $newPeople->starships = $starshipsJson;
                    $newPeople->created = $people['created'];
                    $newPeople->edited = $people['edited'];
                    $newPeople->url = $people['url'];

                    $newPeople->save();

                    // attach the films and starships relationships
                    foreach ($people['films'] as $filmUrl) {
                        $film = Film::where('url', $filmUrl)->first();
                        if ($film) {
                            $newPeople->films()->attach($film->id);
                        }
                    }

                    foreach ($people['starships'] as $starshipUrl) {
                        $starship = Starship::where('url', $starshipUrl)->first();
                        if ($starship) {
                            $newPeople->starships()->attach($starship->id);
                        }
                    }
                }
            }
            // check if there are more pages to fetch
            $nextPage = $data['next'];
            $page++;
        } while ($nextPage !== null);

        // log info
        $this->activityLogsController->log('Peoples', 'Fetch');

        return redirect('/table/people')->with('success', 'Characters added to the database');
    }

    public function index()
    {
        return view('tables.people-table');
    }

    public function show($id)
    {
        $people = People::findOrFail($id);
        $comments = $people->comments;

        // log info
        $this->activityLogsController->log('Peoples', 'Show');

        return view('peoples.show', compact('people', 'comments'));
    }

    public function create()
    {
        // log info
        $this->activityLogsController->log('Peoples', 'Create');

        return view('peoples.create');
    }

    public function edit($id)
    {
        $people = People::findOrFail($id);

        // log info
        $this->activityLogsController->log('Peoples', 'Edit');

        return view('peoples.edit', compact('people'));
    }

    public function update(Request $request, $id)
    {
        $people = People::findOrFail($id);

        $people->name = $request->input('name');
        $people->height = $request->input('height');
        $people->mass = $request->input('mass');
        $people->hair_color = $request->input('hair_color');
        $people->skin_color = $request->input('skin_color');
        $people->eye_color = $request->input('eye_color');
        $people->birth_year = $request->input('birth_year');
        $people->gender = $request->input('gender');

        $people->save();

        // log info
        $this->activityLogsController->log('Peoples', 'Update');

        if($people instanceof Model) {
            toastr()->success('Character edited successfully', 'Success');

            // Send an email notification
            try {
                Mail::to('example@gmail.com')->send(new PeopleUpdated($people));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                toastr()->error('Failed to send email', 'Error');
            }

            // Call PeopleUpdated event (Send notification to all the users)
            event(new PeopleUpdated($people));

            $databaseId = env('NOTION_DB_ID');
            $pageId = '3935df3bd9bb42939dba0d688601ad38';

            $page = new Page();
            $page->set('ID', Number::value($people->id));
            $page->set('Name', Title::value($people->name));
            $page->set('Height', Text::value(strval($people->height)));
            $page->set('Mass', Text::value(strval($people->mass)));
            $page->set('Hair_Color', Text::value($people->hair_color));
            $page->set('Skin_Color', Text::value($people->skin_color));
            $page->set('Eye_Color', Text::value($people->eye_color));
            $page->set('Birth_Year', Text::value($people->birth_year));
            $page->set('Gender', Text::value($people->gender));
            $page->set('Type', Text::value('Character'));

            $response = Notion::pages()->createInDatabase($databaseId, $page);

            return redirect('/table/people');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

    }

    public function storeCreate(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'height' => 'required|integer|min:1',
            'mass' => 'required|integer|min:1',
            'hair_color' => 'required|max:255',
            'skin_color' => 'required|max:255',
            'eye_color' => 'required|max:255',
            'birth_year' => 'required|max:255',
            'gender' => 'required|max:255',
        ]);

        // Create a new Film model instance and fill it with the validated data
        $people = new People($validatedData);
        $people->name = $validatedData['name'];

        // Save the new record to the database
        $people->save();

        // log info
        $this->activityLogsController->log('Peoples', 'StoreCreate');

        // Redirect the user to a confirmation page or back to the list view

        if($people instanceof Model) {
            toastr()->success('Character created successfully', 'Success');

            return redirect()->route('peoples.index');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

    }

    public function destroy($id)
    {
        $people = People::findOrFail($id);

        DB::table('people_starships_films')
            ->where('people_id', $id)
            ->update(['people_id' => null]);

        $people->delete();

        // log info
        $this->activityLogsController->log('Peoples', 'Destroy');

        if(!$people->exists) {
            toastr()->success('Character deleted successfully', 'Success');

            return redirect()->route('peoples.index');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

    }

    public function export()
    {
        // log info
        $this->activityLogsController->log('Peoples', 'ExportExcel');

        return Excel::download(new PeoplesExport, 'characters.xlsx');
    }

    public function exportPDF($id)
    {
        // Finds the film
        $people = People::findOrFail($id);

        // Shares the data to the view
        view()->share('people', $people);

        // Transforms into a PDF file
        $pdf = PDF::loadView('pdf.people', $people->toArray());

        // Gives it a name
        $filename = str_replace(' ', '_', $people->name) . '.pdf';

        // log info
        $this->activityLogsController->log('Peoples', 'ExportPDF');

        // Donwloads it
        return $pdf->download($filename);
    }
}
