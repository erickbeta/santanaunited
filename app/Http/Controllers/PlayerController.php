<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     */
    public function index()
    {
        // Filtramos para mostrar solo jugadores activos o destacados.
        $players = Player::where('is_active', true)
                         ->orWhere('is_featured', true)
                         ->with('team')
                         ->orderBy('name')
                         ->paginate(12); 
                         
        return view('dashboard.players.index', compact('players'));
    }

    /**
     * Muestra la ficha de un jugador específico.
     */
    public function show(Player $player)
    {
        // Si quieres que solo se puedan ver jugadores activos:
        if (!$player->is_active) {
             abort(404);
        }

        return view('dashboard.players.show', compact('player'));
    }

    // No se implementan create, store, edit, update, destroy.
}