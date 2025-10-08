<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeContent;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class AdminHomeContentController extends Controller
{
    /**
     * Display content management dashboard
     */
    public function index()
    {
        $sections = [
            'about' => 'About Us Section',
            'player_of_week' => 'Player of the Week',
            'goal_of_week' => 'Goal of the Week',
        ];
        
        // Asegurarse de que $contents siempre sea una colección
        $contents = HomeContent::all()->keyBy('section');
        
        // Si está vacío, crear colección vacía
        if ($contents->isEmpty()) {
            $contents = collect();
        }
        
        return view('admin.home-content.index', compact('sections', 'contents'));
    }

    /**
     * Edit specific content section
     */
    public function edit($section)
    {
        $content = HomeContent::firstOrCreate(
            ['section' => $section],
            [
                'title' => '',
                'subtitle' => '',
                'content' => '',
                'is_active' => true
            ]
        );
        
        $players = Player::where('is_active', true)->get();
        $teams = Team::where('is_active', true)->get();
        
        $selectedPlayerTeamId = null;
        if ($content->data && isset($content->data['player_id'])) {
            $selectedPlayer = Player::find($content->data['player_id']);
            $selectedPlayerTeamId = $selectedPlayer ? $selectedPlayer->team_id : null;
        }
        
        $sections = [
            'about' => 'About Us Section',
            'player_of_week' => 'Player of the Week',
            'goal_of_week' => 'Goal of the Week',
        ];
        
        return view('admin.home-content.edit', compact('content', 'section', 'players', 'sections', 'teams', 'selectedPlayerTeamId'));
    }

    /**
     * Update content section
     */
    public function update(Request $request, $section)
    {
        $content = HomeContent::where('section', $section)->firstOrFail();
        
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'player_id' => 'nullable|exists:players,id',
            'player_id_goal' => 'nullable|exists:players,id',
            'opponent' => 'nullable|string|max:255',
            'match_date' => 'nullable|date',
            'video_url' => 'nullable|url',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($content->image && Storage::disk('public')->exists($content->image)) {
                Storage::disk('public')->delete($content->image);
            }
            
            $path = $request->file('image')->store('home-content', 'public');
            $validated['image'] = $path;
        }

        // Handle JSON data for player of week
        if ($section === 'player_of_week' && $request->filled('player_id')) {
            $player = Player::find($request->player_id);
            $validated['data'] = json_encode([
                'player_id' => $player->id,
                'player_name' => $player->name,
                'stats' => [
                    'goals' => $request->input('stats_goals', 0),
                    'assists' => $request->input('stats_assists', 0),
                    'rating' => $request->input('stats_rating', 0),
                ]
            ]);
        }

        // Handle JSON data for goal of week (CORREGIDO)
        if ($section === 'goal_of_week') {
            $goalData = [
                'date' => $request->input('match_date'),
                'description' => $request->input('description'),
                'video_url' => $request->input('video_url'),
            ];
            
            // Manejar oponente (puede venir de opponent_id o manual)
            if ($request->filled('opponent_id')) {
                $opponentTeam = Team::find($request->opponent_id);
                if ($opponentTeam) {
                    $goalData['opponent_id'] = $opponentTeam->id;
                    $goalData['opponent'] = $opponentTeam->name;
                }
            } elseif ($request->filled('opponent')) {
                $goalData['opponent'] = $request->input('opponent');
            }
            
            // Si se seleccionó un jugador
            if ($request->filled('player_id_goal')) {
                $player = Player::find($request->player_id_goal);
                if ($player) {
                    $goalData['player_id'] = $player->id;
                    $goalData['player_name'] = $player->name;
                }
            } elseif ($request->filled('player_name')) {
                // Si se ingresó manualmente
                $goalData['player_name'] = $request->input('player_name');
            }
            
            $validated['data'] = json_encode($goalData);
        }

        $validated['is_active'] = $request->has('is_active');
        
        $content->update($validated);

        return redirect()
            ->route('admin.home-content.index')
            ->with('success', ucfirst(str_replace('_', ' ', $section)) . ' updated successfully.');
    }

    /**
     * Toggle section active status
     */
    public function toggleActive($section)
    {
        $content = HomeContent::where('section', $section)->firstOrFail();
        $content->update(['is_active' => !$content->is_active]);

        return redirect()
            ->back()
            ->with('success', 'Section status updated successfully.');
    }
}