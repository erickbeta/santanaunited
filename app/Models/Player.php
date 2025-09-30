<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
 


class Player extends Model
{
    use HasFactory; 
   
    protected $fillable = [
        'team_id',
        'name',
        'jersey_number',
        'position',
        'photo_url',
        'goals',
        'assists',
        'birth_date',
        'is_active',
        'is_featured',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

}
