<x-admin-layout title="Crear Nuevo Equipo">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Crear Nuevo Equipo</h1>
            <a href="{{ route('admin.teams.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Volver
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            {{-- ¡IMPORTANTE! enctype es necesario para subir archivos --}}
            <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Campo Nombre --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Equipo *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @else border-gray-300 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo Categoría --}}
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('category') border-red-500 @else border-gray-300 @enderror">
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo Logo --}}
                <div class="mb-4">
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                    <input type="file" name="logo" id="logo" accept="image/*"
                           class="w-full border rounded-lg px-3 py-2 @error('logo') border-red-500 @else border-gray-300 @enderror">
                    @error('logo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo Estado (Activo) --}}
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" class="rounded" checked>
                        <span class="ml-2 text-sm text-gray-700">Equipo Activo</span>
                    </label>
                </div>

                {{-- Botones de acción --}}
                <div class="flex justify-end">
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        <i class="fas fa-save mr-2"></i>Crear Equipo
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>