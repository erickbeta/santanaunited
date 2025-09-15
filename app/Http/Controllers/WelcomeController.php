<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarouselImage;
use App\Models\Game;
use App\Models\Post;
use App\Models\Team;
use App\Models\Player;

class WelcomeController extends Controller
{
    public function index()
    {
        $carouselImages = CarouselImage::where('is_active', true)->get();

        // 2. Obtener los próximos 3 partidos (usando tu tabla 'games')
        $upcomingGames = Game::where('game_date', '>=', now())
                             ->orderBy('game_date', 'asc')
                             ->take(3)
                             ->get();
        
        // 3. Obtener los últimos 3 resultados
        $latestResults = Game::where('game_date', '<', now())
                               ->whereNotNull('score_local') // Asumimos que un partido jugado tiene marcador
                               ->orderBy('game_date', 'desc')
                               ->take(3)
                               ->get();

        // 4. Obtener las últimas 3 noticias (usando tu tabla 'posts')
        $latestPosts = Post::orderBy('created_at', 'desc')->take(3)->get();

        // ... Y así sucesivamente para la tabla de posiciones, jugador del mes, etc.

        // 5. Pasamos todos los datos a la vista
        return view('welcome', [
            'carouselImages' => $carouselImages,
            'upcomingGames' => $upcomingGames,
            'latestResults' => $latestResults,
            'latestPosts' => $latestPosts,
            // 'teams' => $teams,
            // 'featuredPlayer' => $featuredPlayer,
        ]);
    }
}
