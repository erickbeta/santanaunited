<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Controladores Públicos
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;

// Controladores del Administrador
use App\Http\Controllers\Admin\AdminCarouselImageController;
use App\Http\Controllers\Admin\AdminGameController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminPlayerController;
use App\Http\Controllers\Admin\AdminTeamController;
use App\Http\Controllers\Admin\AdminHomeContentController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
| Rutas accesibles para invitados y usuarios autenticados.
*/

// Home / Landing Page
Route::get('/', [WelcomeController::class, 'index'])->name('home');

// Juegos / Calendario y Resultados
Route::resource('games', GameController::class)->only(['index', 'show'])->names('games');

// Noticias / Posts
Route::resource('posts', PostController::class)->only(['index', 'show'])->names('posts');

// Jugadores
Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');

// Clasificación / Posiciones
Route::get('/standings', [TeamController::class, 'index'])->name('stats.index');


/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN Y PERFIL
|--------------------------------------------------------------------------
*/

// La ruta del dashboard por defecto está comentada, usamos 'home' o 'admin.dashboard'
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


/*
|--------------------------------------------------------------------------
| RUTAS DEL ADMINISTRADOR
|--------------------------------------------------------------------------
| Requiere autenticación y el rol 'admin'.
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard del Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Módulo de Carrusel
    Route::resource('carousel', AdminCarouselImageController::class);
    
    // Módulo de Juegos (Partidos)
    // NOTA: La ruta PATCH debe ir ANTES de la ruta resource 'games' para que no sea interceptada.
    Route::patch('games/{game}/update-score', [AdminGameController::class, 'updateScore'])
        ->name('games.update-score');
    Route::resource('games', AdminGameController::class);
    
    // Módulo de Noticias (Posts)
    Route::resource('posts', AdminPostController::class);
    
    // Módulos de Jugadores y Equipos
    Route::resource('players', AdminPlayerController::class);
    Route::resource('teams', AdminTeamController::class);

    // Módulo de Contenido de la Página de Inicio
    Route::controller(AdminHomeContentController::class)->prefix('home-content')->name('home-content.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{section}/edit', 'edit')->name('edit');
        Route::put('/{section}', 'update')->name('update');
        Route::patch('/{section}/toggle', 'toggleActive')->name('toggle');
    });
});

require __DIR__.'/auth.php';