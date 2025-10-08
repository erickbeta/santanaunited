<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = [
        'name', 
        'logo_path', 
        'category',
        'is_active',
    ];

    /**
     * Partidos donde el equipo es local (home_team_id)
     */
    public function homeGames(): HasMany
    {
        return $this->hasMany(Game::class, 'home_team_id');
    }

    /**
     * Partidos donde el equipo es visitante (away_team_id)
     */
    public function awayGames(): HasMany
    {
        return $this->hasMany(Game::class, 'away_team_id');
    }

    /**
     * Partidos como team1
     */
    public function team1Games(): HasMany
    {
        return $this->hasMany(Game::class, 'team1_id');
    }

    /**
     * Partidos como team2
     */
    public function team2Games(): HasMany
    {
        return $this->hasMany(Game::class, 'team2_id');
    }

    /**
     * Jugadores del equipo
     */
    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }
}