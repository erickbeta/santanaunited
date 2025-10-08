<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;


class GameController extends Controller
{
    public function index (Request $request)
    {
        $games = Game::with(['homeTeam', 'awayTeam',])
            ->latest()
            ->paginate(10);

            
        return view('games.index', compact('games'));
    }
}