<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\People;
use App\Models\Film;
use App\Models\Starship;
use App\Exports\PeoplesExport;
use Maatwebsite\Excel\Facades\Excel;

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
                    $newPeople->name = $people['name'];
                    $newPeople->height = $people['height'];
                    $newPeople->mass = $people['mass'];
                    $newPeople->hair_color = $people['hair_color'];
                    $newPeople->skin_color = $people['skin_color'];
                    $newPeople->eye_color = $people['eye_color'];
                    $newPeople->birth_year = $people['birth_year'];
                    $newPeople->gender = $people['gender'];
                    $newPeople->homeworld = $people['homeworld'];
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

        return redirect('/table/peoples')->with('success', 'Characters added to the database');
    }

    public function index()
    {
        return view('tables.people-table');
    }

    public function show($id)
    {
        $people = People::findOrFail($id);
        return view('peoples.show', compact('people'));
    }

    public function export()
    {
        return Excel::download(new PeoplesExport, 'characters.xlsx');
    }
}
