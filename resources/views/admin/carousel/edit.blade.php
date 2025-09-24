<x-admin-layout :title="'Editar Imagen del Carrusel'">

    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Editar Imagen del Carrusel</h1>
            <a href="{{ route('admin.carousel.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                <i class="fa-solid fa-arrow-left mr-2"></i> Volver al Listado
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('admin.carousel.update', $image) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Imagen actual --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Imagen Actual</label>
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}" class="h-32 w-64 object-cover rounded-md">
                </div>

                {{-- Subir nueva imagen --}}
                <div class="mb-4">
                    <label for="image_path" class="block text-gray-700 font-medium mb-2">Cambiar Imagen (opcional)</label>
                    <input type="file" name="image_path" id="image_path" class="border border-gray-300 p-2 rounded-md w-full">
                </div>

                {{-- Título --}}
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Título</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $image->title) }}" class="border border-gray-300 p-2 rounded-md w-full">
                </div>

                {{-- Caption --}}
                <div class="mb-4">
                    <label for="caption" class="block text-gray-700 font-medium mb-2">Descripción</label>
                    <textarea name="caption" id="caption" rows="3" class="border border-gray-300 p-2 rounded-md w-full">{{ old('caption', $image->caption) }}</textarea>
                </div>

                {{-- Orden --}}
                <div class="mb-4">
                    <label for="order" class="block text-gray-700 font-medium mb-2">Orden</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $image->order) }}" class="border border-gray-300 p-2 rounded-md w-full">
                </div>

                {{-- Activo --}}
                <div class="mb-4 flex items-center space-x-2">
                    <input type="checkbox" name="is_active" id="is_active" {{ $image->is_active ? 'checked' : '' }} class="h-4 w-4">
                    <label for="is_active" class="text-gray-700 font-medium">Activo</label>
                </div>

                {{-- Botones --}}
                <div class="flex space-x-4 mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                        Guardar Cambios
                    </button>
                    <a href="{{ route('admin.carousel.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

</x-admin-layout>