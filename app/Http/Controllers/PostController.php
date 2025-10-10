<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Muestra la lista de noticias publicadas.
     * Utiliza el scope 'published' para filtrar solo el contenido listo.
     */
    public function index()
    {
        // 1. Obtener los posts publicados, ordenados por fecha de publicación descendente (más recientes primero).
        // 2. Paginar los resultados para no cargar demasiados datos a la vez.
        $posts = Post::published()
                     ->orderBy('published_at', 'desc')
                     ->paginate(9);

        // Retorna la vista de índice con la colección de posts.
        return view('posts.index', compact('posts'));
    }

    /**
     * Muestra una noticia específica.
     */
    public function show(Post $post)
    {
      
        if (!$post->is_published || $post->published_at > now()) {
            abort(404);
        }
        
        return view('posts.show', compact('post'));
    }
}
