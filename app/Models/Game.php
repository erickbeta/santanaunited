<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'game_date',
        'location',
        'score_local',
        'away_team_score',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'game_date' => 'datetime',
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }


    public function scopeUpcoming($query)
    {
        return $query->where('game_date', '>=', now())
                     ->where('is_active', true)
                     ->orderBy('game_date', 'asc');
    }

    // Solo juegos activos
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}
