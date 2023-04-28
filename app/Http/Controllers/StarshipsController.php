<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use App\Models\Starship;
use App\Models\People;
use App\Models\Film;
use App\Exports\StarshipsExport;
use Maatwebsite\Excel\Facades\Excel;
use Yoeunes\Toastr\Toastr;
use Illuminate\Support\Facades\DB;
use PDF;
use PHPStan\PhpDocParser\Ast\PhpDoc\TypeAliasImportTagValueNode;

class StarshipsController extends Controller
{
    protected $activityLogsController;

    public function __construct(ActivityLogsController $activityLogsController)
    {
        $this->activityLogsController = $activityLogsController;
    }

    public function default()
    {
        $allStarshipData = cache()->remember('starships.all',now()->addDays(1), function() {
            return $this->getAllStarshipData();
        });

        // log info
        $this->activityLogsController->log('Starships', 'Fetch');

        return view('starships', ['allStarshipData' => $allStarshipData]);
    }

    public function store()
    {
        $page = 1;
        do {
            $response = Http::get('https://swapi.dev/api/starships/', ['page' => $page]);
            $data = $response->json();
            $starships = $data['results'];

            foreach ($starships as $starship) {
                // prevent starship duplication
                $existingStarship = Starship::where('name', $starship['name'])->first();
                if (!$existingStarship) {

                    // request pilots and films to get the names before enconding and saving on the database
                    $pilots = collect($starship['pilots'])
                        ->map(function ($url) {
                            $response = Http::get($url);
                            $data = $response->json();
                            $name = isset($data['name']) ? $data['name'] : '';
                            return $name;
                        })->reject(function ($name) {
                            return empty($name);
                        })->implode(', ');

                    $films = collect($starship['films'])
                        ->map(function ($url) {
                            $response = Http::get($url);
                            $data = $response->json();
                            $title = isset($data['title']) ? $data['title'] : '';
                            return $title;
                        })->reject(function ($title) {
                            return empty($title);
                        })->implode(', ');

                    // convert pilots and films arrays to JSON
                    $pilotsJson = json_encode($pilots);
                    $filmsJson = json_encode($films);
                    // save the starship data to the database
                    $newStarship = new Starship;
                    $newStarship->name = ucwords($starship['name']);
                    $newStarship->model = ucwords($starship['model']);
                    $newStarship->manufacturer = ucwords($starship['manufacturer']);
                    $newStarship->cost_in_credits = $starship['cost_in_credits'];
                    $newStarship->length = $starship['length'];
                    $newStarship->max_atmosphering_speed = ucwords($starship['max_atmosphering_speed']);
                    $newStarship->crew = $starship['crew'];
                    $newStarship->passengers = $starship['passengers'];
                    $newStarship->cargo_capacity = $starship['cargo_capacity'];
                    $newStarship->consumables = $starship['consumables'];
                    $newStarship->hyperdrive_rating = $starship['hyperdrive_rating'];
                    $newStarship->MGLT = $starship['MGLT'];
                    $newStarship->starship_class = ucwords($starship['starship_class']);
                    $newStarship->pilots = $pilotsJson;
                    $newStarship->films = $filmsJson;
                    $newStarship->created = $starship['created'];
                    $newStarship->edited = $starship['edited'];
                    $newStarship->url = $starship['url'];

                    $newStarship->save();
                }
            }
            // check if there are more pages to fetch
            $nextPage = $data['next'];
            $page++;
        } while ($nextPage !== null);

        // log info
        $this->activityLogsController->log('Starships', 'Fetch');

        return redirect('/table/starship')->with('success', 'Starships added to the database');
    }

    public function index()
    {
        return view('tables.starship-table');
    }

    public function show($id)
    {
        $starship = Starship::findOrFail($id);
        $comments = $starship->comments;

        // log info
        $this->activityLogsController->log('Starships', 'Show');

        return view('starships.show', compact('starship', 'comments'));
    }

    public function create()
    {
        $peoples = People::all('id', 'name');
        $films = Film::all('id', 'title');

        // log info
        $this->activityLogsController->log('Starships', 'Create');

        return view('starships.create', compact('peoples', 'films'));
    }

    public function edit($id)
    {
        $starship = Starship::findOrFail($id);
        $peoples = People::all('id', 'name');
        $films = Film::all('id', 'title');

        // log info
        $this->activityLogsController->log('Starships', 'Edit');

        return view('starships.edit', compact('starship', 'peoples', 'films'));
    }

    public function update(Request $request, $id)
    {
        $starship = Starship::findOrFail($id);

        $starship->name = $request->input('name');
        $starship->model = $request->input('model');
        $starship->manufacturer = $request->input('manufacturer');
        $starship->max_atmosphering_speed = $request->input('max_atmosphering_speed');
        $starship->crew = $request->input('crew');
        $starship->passengers = $request->input('passengers');
        $starship->starship_class = $request->input('starship_class');
        $starship->pilots = $request->input('pilots');
        $starship->films = $request->input('films');

        $starship->save();

        // log info
        $this->activityLogsController->log('Starships', 'Update');

        if($starship instanceof Model) {
            toastr()->success('Starship edited successfully', 'Success');

            return redirect('/table/starship');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

    }

    public function storeCreate(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'model' => 'required|max:255',
            'manufacturer' => 'required|max:255',
            'max_atmosphering_speed' => 'required|integer|min:1',
            'crew' => 'required|integer|min:1',
            'passengers' => 'required|integer|min:1',
            'starship_class' => 'required|max:255',
            'pilots' => 'nullable|array',
            'pilots.*' => 'integer|min:1',
            'films' => 'nullable|array',
            'films.*' => 'integer|min:1',
        ]);

        // Create a new Film model instance and fill it with the validated data
        $starship = new Starship($validatedData);
        $starship->name = $validatedData['name'];
        $starship->model = $validatedData['model'];
        $starship->manufacturer = $validatedData['manufacturer'];
        $starship->max_atmosphering_speed = $validatedData['max_atmosphering_speed'];
        $starship->crew = $validatedData['crew'];
        $starship->passengers = $validatedData['passengers'];
        $starship->starship_class = $validatedData['starship_class'];
        // $starship->pilots = json_encode($validatedData['pilots']);
        // $starship->films = json_encode($validatedData['films']);

        // Save the new record to the database
        $starship->save();

        // log info
        $this->activityLogsController->log('Starships', 'StoreCreate');

        // Redirect the user to a confirmation page or back to the list view
        if($starship instanceof Model) {
            toastr()->success('Starship created successfully', 'Success');

            return redirect()->route('starships.index');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();
    }

    public function destroy($id)
    {
        $starship = Starship::findOrFail($id);

        // Set the foreign key references to null
        DB::table('people_starships_films')
            ->where('starships_id', $id)
            ->update(['starships_id' => null]);

        // Delete the starship
        $starship->delete();

        // log info
        $this->activityLogsController->log('Starships', 'Destroy');

        if(!$starship->exists) {
            toastr()->success('Starship deleted successfully', 'Success');

            return redirect()->route('starships.index');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

    }

    private function getAllStarshipData()
    {
        $allStarshipData = [];

        // fetch data from the first page
        $starshipData = Http::get('https://swapi.dev/api/starships/')->json();

        // append the result into the $allStarshipData array
        $allStarshipData = array_merge($allStarshipData, $starshipData['results']);

        // check if there is any more pages
        while ($starshipData['next']) {
            $starshipData = Http::get($starshipData['next'])->json();
            $allStarshipData = array_merge($allStarshipData, $starshipData['results']);
        }

        return $allStarshipData;
    }

    public function export()
    {
        // log info
        $this->activityLogsController->log('Starships', 'ExportExcel');

        return Excel::download(new StarshipsExport, 'starships.xlsx');
    }

    public function exportPDF($id)
    {
        // Finds the starship
        $starship = Starship::findOrFail($id);

        // Shares the data to the view
        view()->share('starship', $starship);

        // Transforms into a PDF file
        $pdf = PDF::loadView('pdf.starship', $starship->toArray());

        // Gives it a name
        $filename = str_replace(' ', '_', $starship->name) . '.pdf';

        // log info
        $this->activityLogsController->log('Starships', 'ExportPDF');

        // Donwloads it
        return $pdf->download($filename);
    }
}