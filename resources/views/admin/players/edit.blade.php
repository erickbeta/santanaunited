<x-admin-layout :title="'Editar Jugador'">

    <div class="space-y-8" x-data="playerForm()">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-orange-600 via-red-600 to-pink-700 rounded-2xl p-8 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
            
            <div class="relative z-10">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                        <i class="fas fa-user-edit text-2xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Editar Jugador</h1>
                        <p class="text-orange-100 mt-1">Actualiza la información de {{ $player->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="flex items-center text-sm text-gray-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">
                <i class="fas fa-home mr-1"></i> Dashboard
            </a>
            <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
            <a href="{{ route('admin.players.index') }}" class="hover:text-blue-600 transition-colors">
                Jugadores
            </a>
            <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
            <span class="text-gray-900 font-medium">Editar: {{ $player->name }}</span>
        </div>

        <!-- Formulario -->
        <form action="{{ route('admin.players.update', $player) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Información Básica -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-id-card text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Información Básica</h3>
                    </div>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Nombre Completo -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nombre Completo <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $player->name) }}"
                               required
                               class="w-full px-4 py-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('name') border-red-500 @enderror"
                               placeholder="Ej: Juan Carlos Pérez">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Equipo -->
                    <div>
                        <label for="team_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Equipo <span class="text-red-500">*</span>
                        </label>
                        <select name="team_id" 
                                id="team_id" 
                                required
                                class="w-full px-4 py-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('team_id') border-red-500 @enderror">
                            <option value="">Seleccionar equipo...</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ old('team_id', $player->team_id) == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('team_id')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Fecha de Nacimiento -->
                    <div>
                        <label for="birth_date" class="block text-sm font-semibold text-gray-700 mb-2">
                            Fecha de Nacimiento
                        </label>
                        <input type="date" 
                               name="birth_date" 
                               id="birth_date" 
                               value="{{ old('birth_date', $player->birth_date) }}"
                               max="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('birth_date') border-red-500 @enderror">
                        @error('birth_date')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">
                            @if($player->birth_date)
                                Edad actual: {{ \Carbon\Carbon::parse($player->birth_date)->age }} años
                            @else
                                La edad se calculará automáticamente
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Información del Jugador -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-futbol text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Detalles del Jugador</h3>
                    </div>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Número de Camiseta -->
                    <div>
                        <label for="jersey_number" class="block text-sm font-semibold text-gray-700 mb-2">
                            Número de Camiseta
                        </label>
                        <input type="number" 
                               name="jersey_number" 
                               id="jersey_number" 
                               value="{{ old('jersey_number', $player->jersey_number) }}"
                               min="0"
                               max="99"
                               class="w-full px-4 py-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('jersey_number') border-red-500 @enderror"
                               placeholder="Ej: 10">
                        @error('jersey_number')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Posición -->
                    <div>
                        <label for="position" class="block text-sm font-semibold text-gray-700 mb-2">
                            Posición
                        </label>
                        <select name="position" 
                                id="position" 
                                class="w-full px-4 py-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('position') border-red-500 @enderror">
                            <option value="">Seleccionar posición...</option>
                            <option value="Portero" {{ old('position', $player->position) == 'Portero' ? 'selected' : '' }}>Portero</option>
                            <option value="Defensa" {{ old('position', $player->position) == 'Defensa' ? 'selected' : '' }}>Defensa</option>
                            <option value="Mediocampo" {{ old('position', $player->position) == 'Mediocampo' ? 'selected' : '' }}>Mediocampo</option>
                            <option value="Delantero" {{ old('position', $player->position) == 'Delantero' ? 'selected' : '' }}>Delantero</option>
                        </select>
                        @error('position')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Placeholder para alineación -->
                    <div></div>

                    <!-- Goles -->
                    <div>
                        <label for="goals" class="block text-sm font-semibold text-gray-700 mb-2">
                            Goles
                        </label>
                        <input type="number" 
                               name="goals" 
                               id="goals" 
                               value="{{ old('goals', $player->goals) }}"
                               min="0"
                               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('goals') border-red-500 @enderror"
                               placeholder="0">
                        @error('goals')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Asistencias -->
                    <div>
                        <label for="assists" class="block text-sm font-semibold text-gray-700 mb-2">
                            Asistencias
                        </label>
                        <input type="number" 
                               name="assists" 
                               id="assists" 
                               value="{{ old('assists', $player->assists) }}"
                               min="0"
                               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('assists') border-red-500 @enderror"
                               placeholder="0">
                        @error('assists')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Foto del Jugador -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-camera text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Foto del Jugador</h3>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                        <!-- Preview de la foto -->
                        <div class="flex-shrink-0">
                            <div class="w-32 h-32 rounded-full overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center border-4 border-white shadow-lg">
                                @if($player->photo_url)
                                    <img id="photo-preview" src="{{ asset('storage/' . $player->photo_url) }}" alt="{{ $player->name }}" class="w-full h-full object-cover">
                                    <i id="photo-placeholder" class="fas fa-user text-4xl text-gray-400 hidden"></i>
                                @else
                                    <img id="photo-preview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                                    <i id="photo-placeholder" class="fas fa-user text-4xl text-gray-400"></i>
                                @endif
                            </div>
                        </div>

                        <!-- Input de archivo -->
                        <div class="flex-1 w-full">
                            <label for="photo_url" class="block text-sm font-semibold text-gray-700 mb-2">
                                Cambiar Fotografía
                            </label>
                            <input type="file" 
                                   name="photo_url" 
                                   id="photo_url" 
                                   accept="image/*"
                                   @change="previewPhoto($event)"
                                   class="w-full px-4 py-3 border  rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('photo_url') border-red-500 @enderror">
                            @error('photo_url')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Deja vacío para mantener la foto actual. Formatos: JPG, PNG, JPEG. Máximo: 2MB
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estados y Configuración -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-orange-50 to-amber-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-sliders-h text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Estado y Visibilidad</h3>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    
                    <!-- Estado Activo -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                            <div>
                                <label for="is_active" class="text-sm font-semibold text-gray-900">Jugador Activo</label>
                                <p class="text-sm text-gray-500">El jugador está disponible para jugar</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   name="is_active" 
                                   id="is_active" 
                                   value="1"
                                   {{ old('is_active', $player->is_active) ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                        </label>
                    </div>

                    <!-- Jugador Destacado -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-star text-yellow-600"></i>
                            </div>
                            <div>
                                <label for="is_featured" class="text-sm font-semibold text-gray-900">Jugador Destacado</label>
                                <p class="text-sm text-gray-500">Mostrar en la página principal y destacados</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   name="is_featured" 
                                   id="is_featured" 
                                   value="1"
                                   {{ old('is_featured', $player->is_featured) ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row justify-end gap-4">
                        <a href="{{ route('admin.players.index') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 font-semibold transition-all duration-200">
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-save mr-2"></i>
                            Actualizar Jugador
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@push('scripts')
<script>
    function playerForm() {
        return {
            previewPhoto(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const preview = document.getElementById('photo-preview');
                        const placeholder = document.getElementById('photo-placeholder');
                        
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        placeholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        
        form.addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const teamId = document.getElementById('team_id').value;
            
            if (!name) {
                e.preventDefault();
                alert('Por favor, ingrese el nombre del jugador.');
                document.getElementById('name').focus();
                return false;
            }
            
            if (!teamId) {
                e.preventDefault();
                alert('Por favor, seleccione un equipo.');
                document.getElementById('team_id').focus();
                return false;
            }
            
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Actualizando...';
            submitBtn.disabled = true;
        });

        const sections = document.querySelectorAll('.bg-white');
        sections.forEach((section, index) => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                section.style.transition = 'all 0.6s ease-out';
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endpush

</x-admin-layout>