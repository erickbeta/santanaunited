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
                $q->where('location', 'like', '%' . $search . '%')
                  ->orWhere('competition', 'like', '%' . $search . '%');
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
        $santaAnaTeam = Team::where('name', 'Santa Ana United')->first();
        
        if (!$santaAnaTeam) {
            return redirect()->route('admin.games.index')
                ->with('error', 'No se encontró el equipo Santa Ana United en la base de datos');
        }

        $teams = Team::where('id', '!=', $santaAnaTeam->id)
            ->orderBy('name')
            ->get();
            
        return view('admin.games.create', compact('teams', 'santaAnaTeam'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team1_id'            => 'required|exists:teams,id',
            'team2_id'            => 'required|exists:teams,id|different:team1_id',
            'visitor_designation' => 'required|in:team1,team2',
            'game_date'           => 'required|date|after:now',
            'location'            => 'required|string|max:255',
            'competition'         => 'required|string|max:255',
        ]);

        // Determinar quién es local y quién visitante basado en visitor_designation
        if ($validated['visitor_designation'] === 'team1') {
            // team1 (Santa Ana) es visitante, entonces team2 es local
            $homeTeamId = $validated['team2_id'];
            $awayTeamId = $validated['team1_id'];
        } else {
            // team2 es visitante, entonces team1 (Santa Ana) es local
            $homeTeamId = $validated['team1_id'];
            $awayTeamId = $validated['team2_id'];
        }

        Game::create([
            'team1_id'        => $validated['team1_id'],
            'team2_id'        => $validated['team2_id'],
            'home_team_id'    => $homeTeamId,
            'away_team_id'    => $awayTeamId,
            'game_date'       => $validated['game_date'],
            'location'        => $validated['location'],
            'competition'     => $validated['competition'],
        ]);

        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Partido creado exitosamente.');
    }

    public function show(string $id)
    {
        $game = Game::with(['team1', 'team2', 'homeTeam', 'awayTeam'])->findOrFail($id);
        return view('admin.games.show', compact('game'));
    }

    public function edit(string $id)
    {
        $game = Game::findOrFail($id);
        $santaAnaTeam = Team::where('name', 'Santa Ana United')->first();
        $teams = Team::where('id', '!=', $santaAnaTeam->id)
            ->orderBy('name')
            ->get();
            
        return view('admin.games.edit', compact('game', 'teams', 'santaAnaTeam'));
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'team1_id'            => 'required|exists:teams,id',
            'team2_id'            => 'required|exists:teams,id|different:team1_id',
            'visitor_designation' => 'required|in:team1,team2',
            'game_date'           => 'required|date',
            'location'            => 'required|string|max:255',
            'competition'         => 'required|string|max:255',
            'score_local'         => 'nullable|integer|min:0',
            'score_visitor'       => 'nullable|integer|min:0',
        ]);

        // Determinar quién es local y quién visitante
        if ($validated['visitor_designation'] === 'team1') {
            $homeTeamId = $validated['team2_id'];
            $awayTeamId = $validated['team1_id'];
        } else {
            $homeTeamId = $validated['team1_id'];
            $awayTeamId = $validated['team2_id'];
        }

        $game->update([
            'team1_id'        => $validated['team1_id'],
            'team2_id'        => $validated['team2_id'],
            'home_team_id'    => $homeTeamId,
            'away_team_id'    => $awayTeamId,
            'game_date'       => $validated['game_date'],
            'location'        => $validated['location'],
            'competition'     => $validated['competition'],
            'score_local'     => $validated['score_local'] ?? null,
            'score_visitor'   => $validated['score_visitor'] ?? null,
        ]);

        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Partido actualizado exitosamente.');
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Partido eliminado exitosamente.');
    }

    public function updateScore(Request $request, Game $game)
    {
        $validated = $request->validate([
            'score_local'   => 'required|integer|min:0',
            'score_visitor' => 'required|integer|min:0',
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