<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StarshipsController;
use App\Http\Controllers\PeoplesController;
use App\Http\Controllers\FilmsController;
use App\Models\Starship;
use App\Models\Film;
use App\Models\People;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fetch', function () {
    return view('fetch');
})->middleware(['auth', 'verified'])->name('fetch');

Route::get('/table', function () {
    return view('tables.menu');
})->middleware(['auth', 'verified'])->name('table');

Route::get('/dashboard', function () {
    $totalStarships = Starship::count();
    $totalFilms = Film::count();
    $totalPeoples = People::count();

    $people = People::where('birth_year', '!=', 'unknown')->get()->toArray();

    usort($people, function($a, $b) {
        $a_num = (int) str_replace(['BBY', 'ABY'], '', $a['birth_year']);
        $b_num = (int) str_replace(['BBY', 'ABY'], '', $b['birth_year']);
        return $a_num - $b_num;

    });

    $oldestPeople = array_reverse(array_slice($people, -10));

    $data = [
        'totalStarships' => $totalStarships,
        'totalFilms' => $totalFilms,
        'totalPeoples' => $totalPeoples,
        'oldestPeople' => $oldestPeople,
    ];

    return view('dashboard')->with($data);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile related
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::delete('/2fa', [ProfileController::class, 'destroy2fa'])->name('profile.destroy.2fa');

    // Starship related
    Route::get('/starships/create', [StarshipsController::class, 'create'])->name('starships.create');
    Route::get('/starships', [StarshipsController::class, 'default'])->name('starships.default');
    Route::get('/starships/store', [StarshipsController::class, 'store'])->name('starships.store');
    Route::get('/table/starship',[StarshipsController::class, 'index'])->name('starships.index');
    Route::get('/starships/{starship:id}',[StarshipsController::class, 'show'])->name('starships.show');
    Route::delete('/starships/{id}', [StarshipsController::class, 'destroy'])->name('starships.destroy');
    Route::post('/starships/storeCreate', [StarshipsController::class, 'storeCreate'])->name('starships.storeCreate');

    // People related
    Route::get('/peoples/create', [PeoplesController::class, 'create'])->name('peoples.create');
    Route::get('/peoples', [PeoplesController::class, 'default'])->name('peoples.default');
    Route::get('/peoples/store', [PeoplesController::class, 'store'])->name('peoples.store');
    Route::get('/table/people',[PeoplesController::class, 'index'])->name('peoples.index');
    Route::get('/peoples/{people:id}',[PeoplesController::class, 'show'])->name('peoples.show');
    Route::delete('/peoples/{id}', [PeoplesController::class, 'destroy'])->name('peoples.destroy');
    Route::post('/peoples/storeCreate', [PeoplesController::class, 'storeCreate'])->name('peoples.storeCreate');

    // Film  related
    Route::get('/films/create', [FilmsController::class, 'create'])->name('films.create');
    Route::get('/films', [FilmsController::class, 'default'])->name('films.default');
    Route::get('/films/store', [FilmsController::class, 'store'])->name('films.store');
    Route::get('/table/film',[FilmsController::class, 'index'])->name('films.index');
    Route::get('/films/{film:id}',[FilmsController::class, 'show'])->name('films.show');
    Route::delete('/films/{id}', [FilmsController::class, 'destroy'])->name('films.destroy');
    Route::post('/films/storeCreate', [FilmsController::class, 'storeCreate'])->name('films.storeCreate');

});

// Excel Routes
Route::post('starships/export', [StarshipsController::class, 'export'])->name('starships.export');
Route::post('peoples/export', [PeoplesController::class, 'export'])->name('peoples.export');
Route::post('films/export', [FilmsController::class, 'export'])->name('films.export');


Route::middleware(['2fa'])->group(function () {

    Route::get('/dashboard', function () {
        $totalStarships = Starship::count();
        $totalFilms = Film::count();
        $totalPeoples = People::count();

        $people = People::where('birth_year', '!=', 'unknown')->get()->toArray();

        usort($people, function($a, $b) {
            $a_num = (int) str_replace(['BBY', 'ABY'], '', $a['birth_year']);
            $b_num = (int) str_replace(['BBY', 'ABY'], '', $b['birth_year']);
            return $a_num - $b_num;

        });

        $oldestPeople = array_reverse(array_slice($people, -10));

        $data = [
            'totalStarships' => $totalStarships,
            'totalFilms' => $totalFilms,
            'totalPeoples' => $totalPeoples,
            'oldestPeople' => $oldestPeople,
        ];

        return view('dashboard')->with($data);
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::post('/2fa', function () {
        return redirect('dashboard');
    })->name('2fa');
});

Route::get('/complete-registration', [App\Http\Controllers\Auth\RegisteredUserController::class, 'completeRegistration'])
    ->name('complete-registration');

/**
 *  Send 2FA to users email
 *
 */
Route::get('/2fa/token', [RegisteredUserController::class, 'sendGoogle2FACode'])
    ->middleware(['auth', '2fa'])
    ->name('2fa.token');



require __DIR__.'/auth.php';