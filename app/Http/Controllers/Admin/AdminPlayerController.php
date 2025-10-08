<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class AdminPlayerController extends Controller
{
    /**
     * Muestra la lista de jugadores para el administrador.
     */
    public function index()
    {
        $players = Player::with('team')->paginate(15); 
        return view('admin.players.index', compact('players'));
    }

    /**
     * Muestra el formulario para crear un nuevo jugador.
     */
    public function create()
    {
        $teams = Team::all(); 
        return view('admin.players.create', compact('teams'));
    }

    /**
     * Almacena un jugador recién creado.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'team_id'       => 'required|exists:teams,id',
            'birth_date'    => 'nullable|date|before:today',
            'jersey_number' => 'nullable|integer|min:0|max:99',
            'position'      => 'nullable|string|max:50',
            'goals'         => 'nullable|integer|min:0',
            'assists'       => 'nullable|integer|min:0',
            'photo_url'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active'     => 'nullable|boolean',
            'is_featured'   => 'nullable|boolean',
        ]);

        // Manejar la subida de la foto
        if ($request->hasFile('photo_url')) {
            $path = $request->file('photo_url')->store('players', 'public');
            $validated['photo_url'] = $path;
        }

        // Convertir checkboxes a booleanos
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['is_featured'] = $request->has('is_featured') ? true : false;

        // Calcular edad si hay fecha de nacimiento
        if (isset($validated['birth_date'])) {
            $birthDate = new \DateTime($validated['birth_date']);
            $today = new \DateTime();
            $validated['age'] = $today->diff($birthDate)->y;
        }

        Player::create($validated);

        return redirect()
            ->route('admin.players.index')
            ->with('success', 'Jugador creado exitosamente.');
    }

    /**
     * Muestra un jugador específico.
     */
    public function show(Player $player)
    {
        return view('admin.players.show', compact('player'));
    }

    /**
     * Muestra el formulario para editar un jugador existente.
     */
    public function edit(Player $player)
    {
        $teams = Team::all(); 
        return view('admin.players.edit', compact('player', 'teams'));
    }

    /**
     * Actualiza un jugador específico.
     */
    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'team_id'       => 'required|exists:teams,id',
            'birth_date'    => 'nullable|date|before:today',
            'jersey_number' => 'nullable|integer|min:0|max:99',
            'position'      => 'nullable|string|max:50',
            'goals'         => 'nullable|integer|min:0',
            'assists'       => 'nullable|integer|min:0',
            'photo_url'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active'     => 'nullable|boolean',
            'is_featured'   => 'nullable|boolean',
        ]);

        // Manejar la nueva foto
        if ($request->hasFile('photo_url')) {
            // Eliminar foto anterior si existe
            if ($player->photo_url && Storage::disk('public')->exists($player->photo_url)) {
                Storage::disk('public')->delete($player->photo_url);
            }
            
            $path = $request->file('photo_url')->store('players', 'public');
            $validated['photo_url'] = $path;
        }

        // Convertir checkboxes a booleanos
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['is_featured'] = $request->has('is_featured') ? true : false;

        // Recalcular edad si cambió la fecha de nacimiento
        if (isset($validated['birth_date'])) {
            $birthDate = new \DateTime($validated['birth_date']);
            $today = new \DateTime();
            $validated['age'] = $today->diff($birthDate)->y;
        }

        $player->update($validated);

        return redirect()
            ->route('admin.players.index')
            ->with('success', 'Jugador actualizado exitosamente.');
    }

    /**
     * Elimina un jugador de la base de datos.
     */
    public function destroy(Player $player)
    {
        // Eliminar foto si existe
        if ($player->photo_url && Storage::disk('public')->exists($player->photo_url)) {
            Storage::disk('public')->delete($player->photo_url);
        }

        $player->delete();

        return redirect()
            ->route('admin.players.index')
            ->with('success', 'Jugador eliminado exitosamente.');
    }
}