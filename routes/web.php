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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/starships', [StarshipsController::class, 'index'])->name('starships.index');
Route::get('/starships/store', [StarshipsController::class, 'store'])->name('starships.store');

Route::get('/peoples', [PeoplesController::class, 'index'])->name('peoples.index');
Route::get('/peoples/store', [PeoplesController::class, 'store'])->name('peoples.store');

Route::get('/films', [FilmsController::class, 'index'])->name('films.index');
Route::get('/films/store', [FilmsController::class, 'store'])->name('films.store');

require __DIR__.'/auth.php';
