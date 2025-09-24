<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Team::query();
        if ($request->filled('search')){
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $teams = $query->latest()->paginate(10);

        return view('admin.teams.index', compact('teams'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams,name',
            'category' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_active' => 'sometimes|boolean',            
        ]);

        $data = $request->except('logo');
        if($request->hasFile('logo')){
            $path = $request->fole('logo')->store('teams-logos', 'public');
            $data['logo_path'] = $path;
        };
        $data['is_active'] = $request->has('is_active'); 

        Team::create($data);
        return redirect()->route('admin.teams.index')->with('success', 'Equipo creado exitosamente.');

        }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {   
        $validated = $request->validated([
            'name'      => ['required', 'string', 'max:255', Rule::unique('teams')->ignore($team->id)],
            'category'  => 'nullable|string|max:255',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'is_active' => 'sometimes|boolean',
        ]);
        $data = $rerquest->except('logo');
        if($request->hasFile('logo')){
            if ($team->logo_path) {
                Storage::disk('public')->delete($team->logo_path);
        }

        $path = $request->file('logo')->store('teams-logos', 'public');
        $data['logo_path'] = $path;
    }
        $data['is_active'] = $request->has('is_active');
        $team->update($data);
        return redirect()->route('admin.teams.index')->with('success', 'Equipo actualizado exitosamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        if ($team->logo_path) {
            Storage:disk('public')->delete($team->logo_path);
        }

        $team->delete();
        return redirect()->route('admin.teams.index')->with('success', 'Equipo eliminado exitosamente.');
    }
}
