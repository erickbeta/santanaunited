<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Post;
use App\Models\Team;
use App\Models\Player;
use App\Models\CarouselImage;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(): View
    {
        // Carrusel de imágenes activas
        $carouselImages = CarouselImage::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Próximos partidos con relaciones
        $upcomingGames = Game::with(['homeTeam', 'awayTeam'])
            ->where('game_date', '>=', now())
            ->where('is_active', true)
            ->orderBy('game_date', 'asc')
            ->limit(3)
            ->get();

        // Últimos resultados
        $latestResults = Game::with(['homeTeam', 'awayTeam'])
            ->where('game_date', '<', now())
            ->whereNotNull('score_local')
            ->whereNotNull('score_visitor')
            ->where('is_active', true)
            ->orderBy('game_date', 'desc')
            ->limit(3)
            ->get();

        // Últimas noticias publicadas
        $latestPosts = Post::where('is_published', true)
            ->latest('created_at')
            ->limit(3)
            ->get();

        // Jugador destacado (con fallback)
        $featuredPlayer = Player::where('is_active', true)
            ->where('is_featured', true)
            ->first()
            ?: Player::where('is_active', true)
                ->orderByDesc('goals')
                ->orderByDesc('assists')
                ->first();

        // Tabla de posiciones
        $teams = $this->getTeamsStandings();

        return view('welcome', compact(
            'carouselImages',
            'upcomingGames',
            'latestResults',
            'latestPosts',
            'teams',
            'featuredPlayer',
        ));
    }

    /**
     * Obtener tabla de posiciones optimizada
     */
    private function getTeamsStandings()
    {

    }
            
            
    /**
     * Obtener estadísticas para el dashboard
     */
    private function getDashboardStats(): array
    {

    }
}
