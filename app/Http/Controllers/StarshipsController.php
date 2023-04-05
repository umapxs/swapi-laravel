<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use App\Models\Starship;
use App\Exports\StarshipsExport;
use App\Exports\StarshipsExportView;
use Maatwebsite\Excel\Facades\Excel;
use PHPStan\PhpDocParser\Ast\PhpDoc\TypeAliasImportTagValueNode;

class StarshipsController extends Controller
{
    public function index()
    {
        $allStarshipData = cache()->remember('starships.all',now()->addDays(1), function() {
            return $this->getAllStarshipData();
        });

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
                    $newStarship->name = $starship['name'];
                    $newStarship->model = $starship['model'];
                    $newStarship->manufacturer = $starship['manufacturer'];
                    $newStarship->cost_in_credits = $starship['cost_in_credits'];
                    $newStarship->length = $starship['length'];
                    $newStarship->max_atmosphering_speed = $starship['max_atmosphering_speed'];
                    $newStarship->crew = $starship['crew'];
                    $newStarship->passengers = $starship['passengers'];
                    $newStarship->cargo_capacity = $starship['cargo_capacity'];
                    $newStarship->consumables = $starship['consumables'];
                    $newStarship->hyperdrive_rating = $starship['hyperdrive_rating'];
                    $newStarship->MGLT = $starship['MGLT'];
                    $newStarship->starship_class = $starship['starship_class'];
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

        return redirect('/fetch')->with('success', 'Starships added to the database');
    }

    public function show()
    {
        return view('tables.starship-table');
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
        return Excel::download(new StarshipsExport(), 'starships.xlsx');
    }

    public function export_view()
    {
        return Excel::download(new StarhipsExportView(), 'starships.xlsx');
    }
}