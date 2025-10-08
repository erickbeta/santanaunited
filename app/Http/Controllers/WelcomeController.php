<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Post;
use App\Models\Team;
use App\Models\Player;
use App\Models\CarouselImage;
use App\Models\HomeContent;
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

        // Contenido editable de la home
        $aboutContent = HomeContent::where('section', 'about')
            ->where('is_active', true)
            ->first();
        
        $playerOfWeek = HomeContent::where('section', 'player_of_week')
            ->where('is_active', true)
            ->first();
        
        $goalOfWeek = HomeContent::where('section', 'goal_of_week')
            ->where('is_active', true)
            ->first();

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

        // Jugadores destacados (4 para la sección Featured Players)
        $featuredPlayers = Player::where('is_active', true)
            ->where('is_featured', true)
            ->limit(4)
            ->get();

        // Si no hay suficientes jugadores destacados, completar con top scorers
        if ($featuredPlayers->count() < 4) {
            $additionalPlayers = Player::where('is_active', true)
                ->where('is_featured', false)
                ->orderByDesc('goals')
                ->orderByDesc('assists')
                ->limit(4 - $featuredPlayers->count())
                ->get();
            
            $featuredPlayers = $featuredPlayers->concat($additionalPlayers);
        }

        // Jugador de la semana desde HomeContent o fallback
        $weekPlayer = null;
        if ($playerOfWeek && !empty($playerOfWeek->data)) {
            $data = is_array($playerOfWeek->data) ? $playerOfWeek->data : json_decode($playerOfWeek->data, true);
            if (isset($data['player_id'])) {
                $weekPlayer = Player::find($data['player_id']);
                if ($weekPlayer) {
                    $weekPlayer->week_stats = $data['stats'] ?? [];
                }
            }
        }
        
        // Fallback si no hay player of week configurado
        if (!$weekPlayer) {
            $weekPlayer = Player::where('is_active', true)
                ->orderByDesc('goals')
                ->first();
        }

        // No modificar $goalOfWeek->data directamente
        // La conversión se hace en la vista Blade

        // Tabla de posiciones
        $teams = $this->getTeamsStandings();

        // Stats del dashboard
        $stats = $this->getDashboardStats();

        return view('welcome', compact(
            'carouselImages',
            'upcomingGames',
            'latestResults',
            'latestPosts',
            'teams',
            'featuredPlayers',
            'weekPlayer',
            'aboutContent',
            'playerOfWeek',
            'goalOfWeek',
            'stats'
        ));
    }

    /**
     * Obtener tabla de posiciones optimizada
     */
    private function getTeamsStandings()
    {
        return Team::where('is_active', true)
            ->get()
            ->map(function ($team) {
                // Obtener todos los partidos del equipo como local
                $homeGames = Game::where('home_team_id', $team->id)
                    ->whereNotNull('score_local')
                    ->whereNotNull('score_visitor')
                    ->get();
                
                // Obtener todos los partidos del equipo como visitante
                $awayGames = Game::where('away_team_id', $team->id)
                    ->whereNotNull('score_local')
                    ->whereNotNull('score_visitor')
                    ->get();

                // Calcular victorias, empates y derrotas como local
                $homeWins = $homeGames->filter(function($game) {
                    return $game->score_local > $game->score_visitor;
                })->count();
                
                $homeDraws = $homeGames->filter(function($game) {
                    return $game->score_local == $game->score_visitor;
                })->count();
                
                $homeLosses = $homeGames->filter(function($game) {
                    return $game->score_local < $game->score_visitor;
                })->count();
                
                // Calcular victorias, empates y derrotas como visitante
                $awayWins = $awayGames->filter(function($game) {
                    return $game->score_visitor > $game->score_local;
                })->count();
                
                $awayDraws = $awayGames->filter(function($game) {
                    return $game->score_visitor == $game->score_local;
                })->count();
                
                $awayLosses = $awayGames->filter(function($game) {
                    return $game->score_visitor < $game->score_local;
                })->count();

                // Totales
                $team->games_played = $homeGames->count() + $awayGames->count();
                $team->wins = $homeWins + $awayWins;
                $team->draws = $homeDraws + $awayDraws;
                $team->losses = $homeLosses + $awayLosses;
                
                $team->goals_for = $homeGames->sum('score_local') + $awayGames->sum('score_visitor');
                $team->goals_against = $homeGames->sum('score_visitor') + $awayGames->sum('score_local');
                
                $team->points = ($team->wins * 3) + ($team->draws * 1);
                $team->goal_difference = $team->goals_for - $team->goals_against;
                
                return $team;
            })
            ->sortByDesc('points')
            ->sortByDesc('goal_difference')
            ->values();
    }
            
    /**
     * Obtener estadísticas para el dashboard
     */
    private function getDashboardStats(): array
    {
        // Buscar el equipo Santana United
        $santanaTeam = Team::where('name', 'LIKE', '%Santana%')
            ->orWhere('name', 'LIKE', '%Santa Ana%')
            ->first();

        $wins = 0;
        if ($santanaTeam) {
            // Victorias como local
            $homeWins = Game::where('home_team_id', $santanaTeam->id)
                ->whereNotNull('score_local')
                ->whereNotNull('score_visitor')
                ->whereColumn('score_local', '>', 'score_visitor')
                ->count();
            
            // Victorias como visitante
            $awayWins = Game::where('away_team_id', $santanaTeam->id)
                ->whereNotNull('score_local')
                ->whereNotNull('score_visitor')
                ->whereColumn('score_visitor', '>', 'score_local')
                ->count();
            
            $wins = $homeWins + $awayWins;
        }

        return [
            'total_players' => Player::where('is_active', true)->count(),
            'total_games' => Game::whereNotNull('score_local')
                ->whereNotNull('score_visitor')
                ->count(),
            'total_goals' => Player::sum('goals'),
            'upcoming_games' => Game::where('game_date', '>=', now())
                ->where('is_active', true)
                ->count(),
            'wins' => $wins,
        ];
    }
}