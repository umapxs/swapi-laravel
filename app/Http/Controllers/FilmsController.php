<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Film;
use App\Exports\FilmsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;


class FilmsController extends Controller
{
    public function default()
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
        return redirect('/table/film')->with('success', 'Films added to the database');
    }

    public function index()
    {
        return view('tables.film-table');
    }

    public function show($id)
    {
        $film = Film::findOrFail($id);
        return view('films.show', compact('film'));
    }

    public function create()
    {
        return view('films.create');
    }

    public function edit()
    {
        return view('films.edit');
    }

    public function storeCreate(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'episode_id' => 'required|integer|min:1|unique:films',
            'director' => 'required|max:255',
            'producer' => 'required|max:255',
            'release_date' => 'required|date|date_format:Y-m-d',
        ]);

        // Create a new Film model instance and fill it with the validated data
        $film = new Film();
        $film->title = $validatedData['title'];
        $film->episode_id = $validatedData['episode_id'];
        $film->director = $validatedData['director'];
        $film->producer = $validatedData['producer'];
        $film->release_date = $validatedData['release_date'];
        $film->opening_crawl = '';

        // Save the new record to the database
        $film->save();

        // Redirect the user to a confirmation page or back to the list view
        return redirect()->route('films.index')->with('success', 'Film created successfully');
    }

    public function destroy($id)
    {
        $film = Film::findOrFail($id);
        $film->delete();

        return redirect()->route('films.index');
    }

    public function export()
    {
        return Excel::download(new FilmsExport, 'films.xlsx');
    }
}
