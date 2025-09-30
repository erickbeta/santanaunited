<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'team1_id',      
        'team2_id',        
        'home_team_id',    
        'away_team_id',  
        'game_date',
        'location',
        'competition',
        'score_local',     
        'score_visitor',   
        'match_report',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'game_date' => 'datetime',
    ];

    // Relaciones principales (equipos fijos)
    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    // Relaciones según condición de juego
    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeUpcoming($query)
    {
        return $query->where('game_date', '>=', now())
                     ->where('is_active', true)
                     ->orderBy('game_date', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFinished($query)
    {
        return $query->where('game_date', '<', now())
                     ->whereNotNull('score_local')
                     ->whereNotNull('score_visitor');
    }

    public function scopePendingResults($query)
    {
        return $query->where('game_date', '<', now())
                     ->whereNull('score_local');
    }

    // Métodos helper útiles
    public function isSantaAnaHome()
    {
        return $this->home_team_id === $this->team1_id;
    }

    public function hasResult()
    {
        return !is_null($this->score_local) && !is_null($this->score_visitor);
    }

    public function isUpcoming()
    {
        return $this->game_date > now();
    }

    public function getResultAttribute()
    {
        if (!$this->hasResult()) {
            return 'Pendiente';
        }
        return "{$this->score_local} - {$this->score_visitor}";
    }

    public function getStatusAttribute()
    {
        if ($this->isUpcoming()) {
            return 'upcoming';
        }
        
        if ($this->hasResult()) {
            return 'finished';
        }
        
        return 'pending';
    }

    // Para mostrar en la UI
    public function getMatchupAttribute()
    {
        $home = $this->homeTeam->name ?? 'TBD';
        $away = $this->awayTeam->name ?? 'TBD';
        
        return "{$home} vs {$away}";
    }
}