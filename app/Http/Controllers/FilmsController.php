<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Film;
use App\Exports\FilmsExport;
use Maatwebsite\Excel\Facades\Excel;

class FilmsController extends Controller
{
    public function index()
    {
        $filmData = Cache::remember('films', now()->addDay(1), function () {
            return Http::get('https://swapi.dev/api/films/')->json();
        });

        return view('films', ['filmData' => $filmData]);
    }

    public function store()
    {
        $url = 'https://swapi.dev/api/films/';
        $data = file_get_contents($url);
        $films = json_decode($data, true)['results'];

        foreach ($films as $film) {
            // prevent starship duplication
            $existingFilm = Film::where('title', $film['title'])->first();
            if (!$existingFilm) {
                // convert pilots and films arrays to JSON
                $charactersJson = json_encode($film['characters']);
                $planetsJson = json_encode($film['planets']);
                $starshipsJson = json_encode($film['starships']);
                $vehiclesJson = json_encode($film['vehicles']);
                $speciesJson = json_encode($film['species']);
                // save the starship data to the database
                $newFilm = new Film;
                $newFilm->title = $film['title'];
                $newFilm->episode_id = $film['episode_id'];
                $newFilm->opening_crawl = $film['opening_crawl'];
                $newFilm->director = $film['director'];
                $newFilm->producer = $film['producer'];
                $newFilm->release_date = $film['release_date'];
                $newFilm->characters = $charactersJson;
                $newFilm->planets = $planetsJson;
                $newFilm->starships = $starshipsJson;
                $newFilm->vehicles = $vehiclesJson;
                $newFilm->species = $speciesJson;
                $newFilm->created = $film['created'];
                $newFilm->edited = $film['edited'];
                $newFilm->url = $film['url'];

                $newFilm->save();
            }
        }
        return redirect('/dashboard')->with('success', 'Films added to the database');
    }

    public function show()
    {
        return view('tables.film-table');
    }

    public function export()
    {
        return Excel::download(new FilmsExport, 'films.xlsx');
    }
}
