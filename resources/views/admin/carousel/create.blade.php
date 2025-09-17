<x-admin-layout :title="'Agregar Imagen'">

    <div class="container mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Añadir Nueva Imagen</h1>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Título</label>
                    <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Título opcional de la imagen">
                </div>

                <div class="mb-4">
                    <label for="caption" class="block text-gray-700 font-bold mb-2">Leyenda (Caption)</label>
                    <textarea name="caption" id="caption" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Texto que aparecerá sobre la imagen"></textarea>
                </div>

                <div class="mb-4">
                    <label for="order" class="block text-gray-700 font-bold mb-2">Orden</label>
                    <input type="number" name="order" id="order" value="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                
                <div class="mb-6">
                    <label for="image_path" class="block text-gray-700 font-bold mb-2">Archivo de Imagen</label>
                    <input type="file" name="image_path" id="image_path" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="is_active">
                        ¿Activo?
                    </label>
                    <input name="is_active" id="is_active" type="checkbox" value="1" checked>
                    <span class="text-sm text-gray-600"> (La imagen será visible en el carrusel)</span>
                </div>

                
                <div class="flex items-center justify-end">
                    <a href="{{ route('admin.carousel.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Cancelar</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                        Guardar Imagen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
