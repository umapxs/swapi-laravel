<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Film;
use App\Exports\FilmsExport;
use Maatwebsite\Excel\Facades\Excel;
use Yoeunes\Toastr\Toastr;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class FilmsController extends Controller
{
    protected $activityLogsController;

    public function __construct(ActivityLogsController $activityLogsController)
    {
        $this->activityLogsController = $activityLogsController;
    }

    public function default()
    {
        $filmData = Cache::remember('films', now()->addDay(1), function () {
            return Http::get('https://swapi.dev/api/films/')->json();
        });

        // log info
        $this->activityLogsController->log('Films', 'Fetch');

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
                $newFilm->title = ucwords($film['title']);
                $newFilm->episode_id = $film['episode_id'];
                $newFilm->opening_crawl = ucwords($film['opening_crawl']);
                $newFilm->director = ucwords($film['director']);
                $newFilm->producer = ucwords($film['producer']);
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
        // log info
        $this->activityLogsController->log('Films', 'Fetch');

        return redirect('/table/film')->with('success', 'Films added to the database');
    }

    public function index()
    {
        return view('tables.film-table');
    }

    public function show($id)
    {
        $film = Film::findOrFail($id);
        $comments = $film->comments;

        // log info
        $this->activityLogsController->log('Films', 'Show');

        return view('films.show', compact('film', 'comments'));
    }

    public function create()
    {
        // log info
        $this->activityLogsController->log('Films', 'Create');

        return view('films.create');
    }

    public function edit($id)
    {
        $film = Film::findOrFail($id);

        // log info
        $this->activityLogsController->log('Films', 'Edit');

        return view('films.edit', compact('film'));
    }

    public function update(Request $request, $id)
    {
        $film = Film::findOrFail($id);

        $film->title = $request->input('title');
        $film->episode_id = $request->input('episode_id');
        $film->director = $request->input('director');
        $film->producer = $request->input('producer');
        $film->release_date = $request->input('release_date');
        $film->save();

        // log info
        $this->activityLogsController->log('Films', 'Update');

        if($film instanceof Model) {
            toastr()->success('Film edited successfully', 'Success');

            return redirect('/table/film');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

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

        // log info
        $this->activityLogsController->log('Films', 'StoreCreate');

        // Redirect the user to a confirmation page or back to the list view
        if($film instanceof Model) {
            toastr()->success('Film created successfully', 'Success');

            return redirect()->route('films.index');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();
    }

    public function destroy($id)
    {
        $film = Film::findOrFail($id);
        DB::table('people_starships_films')
            ->where('films_id', $id)
            ->update(['films_id' => null]);

        // Delete the starship
        $film->delete();

        // Log info
        $this->activityLogsController->log('Films', 'Destroy');

        if(!$film->exists) {
            toastr()->success('Film deleted successfully', 'Success');

            return redirect()->route('films.index');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

    }

    public function export()
    {
        // log info
        $this->activityLogsController->log('Films', 'ExportExcel');

        return Excel::download(new FilmsExport, 'films.xlsx');
    }

    public function exportPDF($id)
    {
        // Finds the film
        $film = Film::findOrFail($id);

        // Shares the data to the view
        view()->share('film', $film);

        // Transforms into a PDF file
        $pdf = PDF::loadView('pdf.film', $film->toArray());

        // Gives it a name
        $filename = str_replace(' ', '_', $film->title) . '.pdf';

        // log info
        $this->activityLogsController->log('Films', 'ExportPDF');

        // Donwloads it
        return $pdf->download($filename);
    }
}
