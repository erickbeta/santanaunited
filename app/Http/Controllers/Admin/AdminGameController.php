<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Game;

class AdminGameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Game::with(['team1', 'team2']);

        // Filtros
        if ($request->filled('status')) {
            if ($request->status === 'upcoming') {
                $query->where('game_date', '>', now());
            } elseif ($request->status === 'finished') {
                $query->where('game_date', '<', now())
                      ->whereNotNull('score_local');
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('location', 'like', '%' . $search . '%');
                // 🚨 opponent y competition no existen, comentado:
                // ->orWhere('opponent', 'like', '%' . $search . '%')
                // ->orWhere('competition', 'like', '%' . $search . '%');
            });
        }

        $games = $query->orderBy('game_date', 'desc')->paginate(15);

        // Estadísticas rápidas
        $stats = [
            'total_games'     => Game::count(),
            'upcoming_games'  => Game::where('game_date', '>', now())->count(),
            'finished_games'  => Game::where('game_date', '<', now())->whereNotNull('score_local')->count(),
            'pending_results' => Game::where('game_date', '<', now())->whereNull('score_local')->count(),
        ];

        return view('admin.games.index', compact('games', 'stats'));
    }

    public function create()
    {
        $teams = Team::orderBy('name')->get();
        return view('admin.games.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_date'      => 'required|date|after:now',
            'location'       => 'required|string|max:255',
            'home_team_id'   => 'required|exists:teams,id',
            'away_team_id'   => 'required|exists:teams,id',
        ]);

        Game::create($validated);

        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Partido creado exitosamente.');
    }

    public function show(string $id)
    {
        $game = Game::with(['homeTeam', 'awayTeam'])->findOrFail($id);
        return view('admin.games.show', compact('game'));
    }

    public function edit(string $id)
    {
        $game = Game::findOrFail($id);
        $teams = Team::orderBy('name')->get();
        return view('admin.games.edit', compact('game', 'teams'));
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'game_date'      => 'required|date',
            'location'       => 'required|string|max:255',
            'home_team_id'   => 'required|exists:teams,id',
            'away_team_id'   => 'required|exists:teams,id',
            'score_local'    => 'nullable|integer|min:0',
            'away_team_score'=> 'nullable|integer|min:0',
        ]);

        $game->update($validated);

        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Partido actualizado exitosamente.');
    }

    public function destroy(string $id, Game $game)
    {
        $game->delete();

        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Partido eliminado exitosamente.');
    }

    public function updateScore(Request $request, Game $game)
    {
        $validated = $request->validate([
            'score_local'     => 'required|integer|min:0',
            'away_team_score' => 'required|integer|min:0',
        ]);

        $game->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Resultado actualizado correctamente',
                'game'    => $game->fresh()
            ]);
        }

        return redirect()->back()->with('success', 'Resultado actualizado correctamente.');
    }
}
