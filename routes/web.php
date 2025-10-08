<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminCarouselImageController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\Admin\AdminGameController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminPlayerController;
use App\Http\Controllers\Admin\AdminTeamController;
use App\Http\Controllers\Admin\AdminHomeContentController;


Route::get('/', [WelcomeController::class, 'index'])->name('home');

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('carousel', AdminCarouselImageController::class);
    
    // Ruta para actualizar score - DEBE estar ANTES del resource
    Route::patch('games/{game}/update-score', [AdminGameController::class, 'updateScore'])
        ->name('games.update-score');
    
    Route::resource('games', AdminGameController::class);
    Route::resource('posts', AdminPostController::class);
    Route::resource('players', AdminPlayerController::class);
    Route::resource('teams', AdminTeamController::class);

    Route::get('/home-content', [AdminHomeContentController::class, 'index'])
        ->name('home-content.index');
    Route::get('/home-content/{section}/edit', [AdminHomeContentController::class, 'edit'])
        ->name('home-content.edit');
    Route::put('/home-content/{section}', [AdminHomeContentController::class, 'update'])
        ->name('home-content.update');
    Route::patch('/home-content/{section}/toggle', [AdminHomeContentController::class, 'toggleActive'])
        ->name('home-content.toggle');

});

Route::resource('games', GameController::class)->only(['index', 'show'])->names('games');
Route::resource('posts', PostController::class)->only(['index', 'show'])->names('posts');
Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');
Route::get('/standings', [TeamController::class, 'index'])->name('stats.index');

    Route::get('/home-content', [AdminHomeContentController::class, 'index'])
        ->name('home-content.index');
    Route::get('/home-content/{section}/edit', [AdminHomeContentController::class, 'edit'])
        ->name('home-content.edit');
    Route::put('/home-content/{section}', [AdminHomeContentController::class, 'update'])
        ->name('home-content.update');
    Route::patch('/home-content/{section}/toggle', [AdminHomeContentController::class, 'toggleActive'])
        ->name('home-content.toggle');

require __DIR__.'/auth.php';