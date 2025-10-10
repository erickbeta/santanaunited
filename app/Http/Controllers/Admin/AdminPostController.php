<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    /**
     * Muestra la lista de noticias (Index).
     */
    public function index()
    {
        // Obtener todos los posts paginados, ordenados por los más recientes primero.
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Muestra el formulario para crear una nueva noticia.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Almacena una nueva noticia en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'body' => 'required|string',
            // se genera automáticamente en el modelo
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $data['is_published'] = $request->has('is_published');
        
        // 1. Manejo de la imagen destacada
        if ($request->hasFile('featured_image')) {
            // Guarda el archivo en el disco 'public' dentro de la carpeta 'posts'
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        // 2. Crear el Post
        Post::create($data);

        return redirect()->route('admin.posts.index')
                         ->with('success', '¡Noticia creada con éxito!');
    }

    /**
     * Muestra una noticia específica
     */
    public function show(Post $post)
    {
        // Opcional: Si quieres una vista de detalle en el admin.
        // return view('admin.posts.show', compact('post'));
        
        // Por lo general, solo rediriges a la edición para el admin.
        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Muestra el formulario para editar la noticia especificada.
     */
    public function edit(Post $post)
    {
        // Laravel automáticamente encuentra el Post por ID (o slug si se configuró en RouteServiceProvider)
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Actualiza la noticia especificada en la base de datos.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'body' => 'required|string',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $data['is_published'] = $request->has('is_published');
        
        // 1. Manejo de la nueva imagen
        if ($request->hasFile('featured_image')) {
            // Eliminar imagen anterior si existe
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            // Almacenar la nueva imagen
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        } else {
            // Si no se sube una nueva imagen, conservamos la existente
            $data['featured_image'] = $post->featured_image;
        }

        // 2. Actualizar el Post
        $post->update($data);

        return redirect()->route('admin.posts.index')
                         ->with('success', '¡Noticia actualizada con éxito!');
    }

    /**
     * Elimina la noticia especificada de la base de datos.
     */
    public function destroy(Post $post)
    {
        // 1. Eliminar la imagen asociada si existe
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        
        // 2. Eliminar el registro de la base de datos
        $post->delete();

        return redirect()->route('admin.posts.index')
                         ->with('success', '¡Noticia eliminada con éxito!');
    }
}
