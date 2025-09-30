<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\Team; 

class AdminPlayerController extends Controller
{
    // NO NECESITAS EL CONSTRUCTOR AQUÍ. 
    // Los middlewares (auth y permisos) se aplican en web.php.

    /**
     * Muestra la lista de jugadores para el administrador.
     */
    public function index()
    {
        // authorizeResource vincula esta acción a PlayerPolicy::viewAny().
        $players = Player::with('team')->paginate(15); 
        return view('admin.players.index', compact('players'));
    }

    /**
     * Muestra el formulario para crear un nuevo jugador.
     */
    public function create()
    {
        // authorizeResource vincula esta acción a PlayerPolicy::create().
        $teams = Team::all(); 
        return view('admin.players.create', compact('teams'));
    }

    /**
     * Almacena un jugador recién creado.
     */
        public function store(Request $request)
    {
        $validated = $request->validate([
            'game_date'      => 'required|date|after:now',
            'location'       => 'required|string|max:255',
            'team1'          => 'required|string|max:255', 
            'team2'          => 'required|string|max:255|different:team1',
            'competition'    => 'required|string|max:255',
            'type'           => 'required|in:local,visitante',
            
        ]);

        $gameData = array_merge($validated, [
            'score_local'     => null, 
            'away_team_score' => null,
            'created_by'      => auth()->id(), 
        ]);
        
        Game::create($gameData); 
        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Partido creado exitosamente.');
    }


    /**
     * Muestra un jugador específico.
     */
    public function show(Player $player)
    {
        // authorizeResource vincula esta acción a PlayerPolicy::view($user, $player).
        return view('admin.players.show', compact('player'));
    }

    /**
     * Muestra el formulario para editar un jugador existente.
     */
    public function edit(Player $player)
    {
        // authorizeResource vincula esta acción a PlayerPolicy::update($user, $player).
        $teams = Team::all(); 
        return view('admin.players.edit', compact('player', 'teams'));
    }

    /**
     * Actualiza un jugador específico.
     */
    public function update(Request $request, Player $player)
    {
        // authorizeResource vincula esta acción a PlayerPolicy::update($user, $player).
        $validatedData = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'name' => 'required|string|max:255',
            // ... otras reglas de validación
        ]);
        
        $player->update($validatedData);

        return redirect()->route('admin.players.index')
                         ->with('success', 'Jugador actualizado exitosamente.');
    }

    /**
     * Elimina un jugador de la base de datos.
     */
    public function destroy(Player $player)
    {
        // authorizeResource vincula esta acción a PlayerPolicy::delete($user, $player).
        $player->delete();

        return redirect()->route('admin.players.index')
                         ->with('success', 'Jugador eliminado exitosamente.');
    }
}