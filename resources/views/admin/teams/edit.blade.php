<x-admin-layout title="Editar Equipo">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Editar Equipo</h1>
            <a href="{{ route('admin.teams.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Volver
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data" id="editTeamForm">
                @csrf
                @method('PUT')

                {{-- Campo Nombre --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Equipo</label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name', $team->name) }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @else border-gray-300 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo Categoría --}}
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                    <input type="text" name="category" id="category" 
                           value="{{ old('category', $team->category) }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @else border-gray-300 @enderror"
                           placeholder="Ej: Primera División, Sub-20, etc.">
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo Logo --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo del Equipo</label>
                    
                    {{-- Logo Actual --}}
                    @if($team->logo_path)
                        <div class="mb-3 flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $team->logo_path) }}" 
                                 alt="Logo de {{ $team->name }}" 
                                 class="h-20 w-20 object-contain rounded-lg border border-gray-200 bg-gray-50 p-2">
                            <div>
                                <p class="text-sm text-gray-600 font-medium">Logo actual</p>
                                <p class="text-xs text-gray-500">Sube un nuevo archivo para reemplazarlo</p>
                            </div>
                        </div>
                    @else
                        <div class="mb-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-sm text-yellow-800">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Este equipo no tiene logo. Sube uno para mejorar la visualización.
                            </p>
                        </div>
                    @endif

                    {{-- Input para nuevo logo --}}
                    <div>
                        <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $team->logo_path ? 'Cambiar Logo (opcional)' : 'Subir Logo' }}
                        </label>
                        <input type="file" name="logo" id="logo" accept="image/*"
                               class="w-full border rounded-lg px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('logo') border-red-500 @else border-gray-300 @enderror">
                        <p class="mt-1 text-xs text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB
                        </p>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Preview del nuevo logo --}}
                    <div id="logo-preview" class="mt-3 hidden">
                        <p class="text-sm font-medium text-gray-700 mb-2">Vista previa del nuevo logo:</p>
                        <img id="logo-preview-img" src="" alt="Vista previa" 
                             class="h-20 w-20 object-contain rounded-lg border border-gray-200 bg-gray-50 p-2">
                    </div>
                </div>

                {{-- Campo Estado (Activo) --}}
                <div class="mb-6">
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <input type="checkbox" name="is_active" id="is_active" value="1" 
                               class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500"
                               {{ old('is_active', $team->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="text-sm font-medium text-gray-700 cursor-pointer">
                            Equipo Activo
                        </label>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Los equipos inactivos no aparecerán en las selecciones de partidos
                    </p>
                </div>

                {{-- Botones de acción --}}
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.teams.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-save mr-2"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editTeamForm');
            const logoInput = document.getElementById('logo');
            const logoPreview = document.getElementById('logo-preview');
            const logoPreviewImg = document.getElementById('logo-preview-img');

            // Preview del logo antes de subir
            logoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                
                if (file) {
                    // Validar tamaño (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('El archivo es demasiado grande. El tamaño máximo es 2MB.');
                        logoInput.value = '';
                        logoPreview.classList.add('hidden');
                        return;
                    }

                    // Validar tipo de archivo
                    if (!file.type.startsWith('image/')) {
                        alert('Por favor selecciona un archivo de imagen válido.');
                        logoInput.value = '';
                        logoPreview.classList.add('hidden');
                        return;
                    }

                    // Mostrar preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        logoPreviewImg.src = e.target.result;
                        logoPreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    logoPreview.classList.add('hidden');
                }
            });

            // Deshabilitar botón al enviar
            form.addEventListener('submit', function(e) {
                const submitButton = form.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Guardando...';
            });
        });
    </script>
    @endpush

    @push('styles')
    <style>
        /* Estilo para campos requeridos */
        label:has(+ input[required])::after,
        label:has(+ select[required])::after {
            content: " *";
            color: #ef4444;
        }
    </style>
    @endpush
</x-admin-layout>