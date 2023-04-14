<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\People;
use App\Models\Film;
use App\Models\Starship;
use App\Exports\PeoplesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PDF;

class PeoplesController extends Controller
{
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

        return view('peoples.show', compact('people', 'comments'));
    }

    public function create()
    {
        return view('peoples.create');
    }

    public function edit($id)
    {
        $people = People::findOrFail($id);
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

        return redirect('/table/people')->with('success', 'Character edited successfully');
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

        // Redirect the user to a confirmation page or back to the list view
        return redirect()->route('peoples.index')->with('success', 'Character created successfully');
    }

    public function destroy($id)
    {
        $people = People::findOrFail($id);

        DB::table('people_starships_films')
            ->where('people_id', $id)
            ->update(['people_id' => null]);

        $people->delete();

        return redirect()->route('peoples.index');
    }

    public function export()
    {
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

        // Donwloads it
        return $pdf->download($filename);
    }
}
