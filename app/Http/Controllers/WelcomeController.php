<?php

namespace App\Http\Controllers;

// No es necesario importar 'Request' si no se usa
use App\Models\Game;
use App\Models\Post;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Support\Facades\DB; 

class WelcomeController extends Controller
{
    public function index()
    {
        $carouselImages = \App\Models\CarouselImage::where('is_active', true)->get();

               $upcomingGames = Game::where('game_date', '>=', now())->orderBy('game_date', 'asc')->take(3)->get();
        $latestResults = Game::where('game_date', '<', now())->whereNotNull('score_local')->orderBy('game_date', 'desc')->take(3)->get();
        $latestPosts = Post::latest()->take(3)->get();
        $featuredPlayer = Player::where('is_featured', true)->first();
        $carouselImages = \App\Models\CarouselImage::where('is_active', true)->get();

        $teams = Team::select('teams.*')
            ->addSelect(DB::raw(
                '(
                    (SELECT COUNT(*) FROM games WHERE home_team_id = teams.id AND score_local > away_team_score AND game_date < NOW()) * 3 +
                    (SELECT COUNT(*) FROM games WHERE away_team_id = teams.id AND away_team_score > score_local AND game_date < NOW()) * 3 +
                    (SELECT COUNT(*) FROM games WHERE (home_team_id = teams.id OR away_team_id = teams.id) AND score_local = away_team_score AND game_date < NOW())
                ) as points'
            ))
            ->orderByDesc('points')
            ->get();
        
        return view('welcome', [
            'upcomingGames' => $upcomingGames,
            'latestResults' => $latestResults,
            'latestPosts' => $latestPosts,
            'teams' => $teams,
            'featuredPlayer' => $featuredPlayer,
            'carouselImages' => $carouselImages,
        ]);
        
    }
}