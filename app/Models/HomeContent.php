<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $fillable = [
        'section',
        'title',
        'subtitle',
        'content',
        'image',
        'data',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'data' => 'array',
    ];
}