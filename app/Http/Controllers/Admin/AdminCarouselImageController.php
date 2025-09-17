<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarouselImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCarouselImageController extends Controller
{
    /**
     * Muestra una lista de todas las imágenes del carrusel.
     */
    public function index()
    {
        $carouselImages = CarouselImage::orderBy('order', 'asc')->get();
        return view('admin.carousel.index', compact('carouselImages'));
    }

    /**
     * Muestra el formulario para crear una nueva imagen.
     */
    public function create()
    {
        return view('admin.carousel.create');
    }

    /**
     * Guarda una nueva imagen en la base de datos y el disco.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'caption' => 'nullable|string',
            'order' => 'integer',
            'is_active' => 'nullable|boolean',
        ]);

        $path = $request->file('image_path')->store('carousel-images', 'public');

        CarouselImage::create([
            'title' => $request->title,
            'caption' => $request->caption,
            'order' => $request->order ?? 0,
            'image_path' => $path,
            'is_active' => $request->has('is_active'),

        ]);

        return redirect()->route('admin.carousel.index')
                         ->with('success', 'Imagen subida correctamente.');
    }

 
    public function edit(CarouselImage $carousel)
    {
        return view('admin.carousel.edit', ['image' => $carousel]);
    }

    /**
     * Actualiza una imagen existente en la base de datos y el disco.
     */
    public function update(Request $request, CarouselImage $carousel)
    {
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // La imagen es opcional al actualizar
            'title' => 'nullable|string|max:255',
            'caption' => 'nullable|string',
            'order' => 'integer'
        ]);
        
        $data = $request->except('image_path'); // Obtenemos todos los datos excepto la imagen

        if ($request->hasFile('image_path')) {
            // Si se sube una nueva imagen:
            // 1. Borramos la imagen antigua del disco
            Storage::disk('public')->delete($carousel->image_path);
            
            // 2. Guardamos la nueva imagen y actualizamos la ruta
            $data['image_path'] = $request->file('image_path')->store('carousel-images', 'public');
        }

        $carousel->update($data);

        return redirect()->route('admin.carousel.index')
                         ->with('success', 'Imagen actualizada correctamente.');
    }

    /**
     * Elimina una imagen de la base de datos y del disco.
     */
    public function destroy(CarouselImage $carousel)
    {
        // 1. Borramos el archivo de imagen del disco
        Storage::disk('public')->delete($carousel->image_path);

        // 2. Borramos el registro de la base de datos
        $carousel->delete();

        return redirect()->route('admin.carousel.index')
                         ->with('success', 'Imagen eliminada correctamente.');
    }
}