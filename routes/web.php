<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StarshipsController;
use App\Http\Controllers\PeoplesController;
use App\Http\Controllers\FilmsController;

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

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/table', function () {
    return view('tables.menu');
})->middleware(['auth', 'verified'])->name('table');

Route::middleware('auth')->group(function () {

    // profile related
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // starship related
    Route::get('/starships', [StarshipsController::class, 'index'])->name('starships.index');
    Route::get('/starships/store', [StarshipsController::class, 'store'])->name('starships.store');
    Route::get('/table/starship',[StarshipsController::class, 'show'])->name('starships.show');

    // people related
    Route::get('/peoples', [PeoplesController::class, 'index'])->name('peoples.index');
    Route::get('/peoples/store', [PeoplesController::class, 'store'])->name('peoples.store');
    Route::get('/table/people',[PeoplesController::class, 'show'])->name('peoples.show');

    // film  related
    Route::get('/films', [FilmsController::class, 'index'])->name('films.index');
    Route::get('/films/store', [FilmsController::class, 'store'])->name('films.store');
    Route::get('/table/film',[FilmsController::class, 'show'])->name('films.show');

});


require __DIR__.'/auth.php';
