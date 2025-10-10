<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'body',
        'featured_image',
        'published_at',
        'is_published',
    ];

        protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        ];

            protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = \Str::slug($post->title);
        });
        
        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                 $post->slug = \Str::slug($post->title);
            }
        });
    }

    /**
     * Scope para obtener solo posts publicados.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

}
