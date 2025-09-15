<?php

namespace App\Http\Controllers\Admin;
use App\Models\CarouselImage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCarouselImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carouselImages = CarouselImage::orderBy('order', 'asc')->get();
        return view('admin.carousel.index', compact('carouselImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
            'caption' => 'nullable|string',
            'order' => 'integer'
        ]);

        $imageName = time().'.'.$request->image_path->extension();
        $request->image_path->move(public_path('images/carousel'), $imageName);

        CarouselImage::create([
            'title' => $request->title,
            'caption' => $request->caption,
            'order' => $request->order ?? 0,
            'image_path' => $imageName,
        ]);

        return redirect()->route('admin.carousel.index')
                         ->with('success', 'Imagen subida correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagePath = public_path('images/carousel/' . $carouselImage->image_path);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Borrar el registro de la base de datos
        $carouselImage->delete();

        return redirect()->route('admin.carousel.index')
                         ->with('success', 'Imagen eliminada correctamente.');
    }
}
