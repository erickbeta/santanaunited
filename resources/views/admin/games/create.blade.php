<x-admin-layout title="Crear Nuevo Partido">
    <div class="container mx-auto px-4 max-w-4xl">
        
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Crear Nuevo Partido ⚽</h1>
            <a href="{{ route('admin.games.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Volver
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.games.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Información básica --}}
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información del Partido</h3>
                    </div>
                    
                    {{-- Campo para Santa Ana United (FIJO como Equipo 1) --}}
                    <div>
                        <label for="team1_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Santa Ana United
                        </label>
                        <div class="w-full border border-blue-300 bg-blue-50 rounded-lg px-3 py-2 text-blue-900 font-semibold flex items-center">
                            <i class="fas fa-star mr-2 text-blue-600"></i>
                            Santa Ana United
                        </div>
                        <input type="hidden" name="team1_id" id="team1_id" value="{{ $santaAnaTeam->id ?? '' }}" required>
                        <p class="mt-1 text-xs text-gray-500">
                        </p>
                        @error('team1_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Campo para Equipo Rival --}}
                    <div>
                        <label for="team2_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Equipo Rival
                        </label>
                        <select name="team2_id" id="team2_id" required
                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('team2_id') border-red-500 @else border-gray-300 @enderror">
                            <option value="">Selecciona el equipo rival</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}" data-name="{{ $team->name }}" {{ old('team2_id') == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('team2_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Seleccionar dónde juega Santa Ana United --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            ¿Dónde juega Santa Ana United?
                        </label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <input type="radio" name="visitor_designation" id="santa_local" value="team2" 
                                       class="peer hidden" 
                                       {{ old('visitor_designation', 'team2') == 'team2' ? 'checked' : '' }} required>
                                <label for="santa_local" 
                                       class="flex items-center justify-center p-4 border-2 rounded-lg cursor-pointer transition-all
                                              peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-900
                                              border-gray-300 hover:border-green-300 hover:bg-gray-50">
                                    <div class="text-center">
                                        <i class="fas fa-home text-2xl mb-2 peer-checked:text-green-600"></i>
                                        <p class="font-semibold">Local 🏠</p>
                                        <p class="text-xs text-gray-600 mt-1">Santa Ana juega en casa</p>
                                    </div>
                                </label>
                            </div>
                            <div>
                                <input type="radio" name="visitor_designation" id="santa_visitante" value="team1" 
                                       class="peer hidden"
                                       {{ old('visitor_designation') == 'team1' ? 'checked' : '' }}>
                                <label for="santa_visitante" 
                                       class="flex items-center justify-center p-4 border-2 rounded-lg cursor-pointer transition-all
                                              peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-900
                                              border-gray-300 hover:border-orange-300 hover:bg-gray-50">
                                    <div class="text-center">
                                        <i class="fas fa-plane-departure text-2xl mb-2 peer-checked:text-orange-600"></i>
                                        <p class="font-semibold">Visitante ✈️</p>
                                        <p class="text-xs text-gray-600 mt-1">Santa Ana juega de visita</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        @error('visitor_designation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="game_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha y Hora</label>
                        <input type="datetime-local" name="game_date" id="game_date" required
                               value="{{ old('game_date') }}"
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('game_date') border-red-500 @else border-gray-300 @enderror">
                        @error('game_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Ubicación</label>
                        <input type="text" name="location" id="location" required
                               value="{{ old('location') }}"
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @else border-gray-300 @enderror"
                               placeholder="Estadio o cancha donde se jugará"
                               list="location-suggestions">
                        <datalist id="location-suggestions">
                            <option value="Estadio Principal">
                            <option value="Campo Municipal">
                            <option value="Cancha Norte">
                        </datalist>
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="competition" class="block text-sm font-medium text-gray-700 mb-2">Competición</label>
                        <input type="text" name="competition" id="competition" required
                               value="{{ old('competition') }}"
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('competition') border-red-500 @else border-gray-300 @enderror"
                               placeholder="Liga Regional, Copa Municipal, etc."
                               list="competition-suggestions">
                        <datalist id="competition-suggestions">
                            <option value="Liga Regional">
                            <option value="Copa Municipal">
                            <option value="Amistoso">
                        </datalist>
                        @error('competition')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Vista previa del partido --}}
                <div class="mt-8 p-4 bg-gradient-to-r from-blue-50 to-gray-50 rounded-lg border-2 border-blue-200">
                    <h4 class="text-md font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-eye mr-2 text-blue-600"></i>
                        Vista Previa del Partido
                    </h4>
                    <div id="game-preview" class="text-sm space-y-2">
                        <div class="flex items-start">
                            <span class="font-medium text-gray-700 min-w-[100px]">Enfrentamiento:</span>
                            <span id="preview-matchup" class="text-gray-900 font-semibold">Selecciona el rival y la condición</span>
                        </div>
                        <div class="flex items-start">
                            <span class="font-medium text-gray-700 min-w-[100px]">Fecha:</span>
                            <span id="preview-date" class="text-gray-900">Selecciona fecha</span>
                        </div>
                        <div class="flex items-start">
                            <span class="font-medium text-gray-700 min-w-[100px]">Ubicación:</span>
                            <span id="preview-location" class="text-gray-900">Ingresa ubicación</span>
                        </div>
                        <div class="flex items-start">
                            <span class="font-medium text-gray-700 min-w-[100px]">Competición:</span>
                            <span id="preview-competition" class="text-gray-900">Ingresa competición</span>
                        </div>
                    </div>
                </div>

                {{-- Botones de acción --}}
                <div class="mt-8 flex justify-end">
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.games.index') }}" 
                           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-save mr-2"></i>Crear Partido
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === Elementos del formulario ===
            const team2Select = document.getElementById('team2_id');
            const visitorRadios = document.querySelectorAll('input[name="visitor_designation"]');
            const dateInput = document.getElementById('game_date');
            const locationInput = document.getElementById('location');
            const competitionInput = document.getElementById('competition');
            const form = document.querySelector('form');
            
            // === Elementos de vista previa ===
            const previewMatchup = document.getElementById('preview-matchup');
            const previewDate = document.getElementById('preview-date');
            const previewLocation = document.getElementById('preview-location');
            const previewCompetition = document.getElementById('preview-competition');

            function getSelectedText(selectElement) {
                if (selectElement.selectedIndex === -1 || selectElement.value === "") {
                    return null;
                }
                return selectElement.options[selectElement.selectedIndex].dataset.name;
            }

            // === Función para actualizar vista previa ===
            function updatePreview() {
                // 1. Actualizar enfrentamiento
                const team2Name = getSelectedText(team2Select) || '[Selecciona rival]';
                const visitor = document.querySelector('input[name="visitor_designation"]:checked')?.value;
                
                let matchupText = 'Selecciona el rival y la condición';
                if(team2Select.value && visitor) {
                    if (visitor === 'team1') {
                        // Santa Ana es visitante (team1 = visitante)
                        matchupText = `${team2Name} 🏠 vs Santa Ana United ✈️`;
                    } else {
                        // Santa Ana es local (team2 = visitante)
                        matchupText = `Santa Ana United 🏠 vs ${team2Name} ✈️`;
                    }
                }
                previewMatchup.textContent = matchupText;

                // 2. Actualizar fecha
                if (dateInput.value) {
                    try {
                        const date = new Date(dateInput.value);
                        const options = { 
                            weekday: 'long',
                            year: 'numeric', 
                            month: 'long', 
                            day: 'numeric', 
                            hour: '2-digit', 
                            minute: '2-digit' 
                        };
                        previewDate.textContent = date.toLocaleDateString('es-ES', options);
                    } catch (e) {
                        previewDate.textContent = 'Fecha inválida';
                    }
                } else {
                    previewDate.textContent = 'Selecciona fecha';
                }

                // 3. Actualizar ubicación
                previewLocation.textContent = locationInput.value.trim() || 'Ingresa ubicación';
                
                // 4. Actualizar competición
                previewCompetition.textContent = competitionInput.value.trim() || 'Ingresa competición';
            }

            // === Event listeners para actualizar vista previa ===
            team2Select.addEventListener('change', updatePreview);
            visitorRadios.forEach(radio => radio.addEventListener('change', updatePreview));
            dateInput.addEventListener('input', updatePreview);
            locationInput.addEventListener('input', updatePreview);
            competitionInput.addEventListener('input', updatePreview);

            // === Lógica del formulario al enviar ===
            form.addEventListener('submit', function(e) {
                const submitButton = form.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creando...';
            });

            // Establecer fecha mínima como ahora
            const now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            dateInput.min = now.toISOString().slice(0,16);

            // Inicializar vista previa
            updatePreview();
        });
    </script>
    @endpush

    @push('styles')
    <style>
        /* Estilo para campos requeridos con CSS para no poner * manuales */
        label:has(+ input[required])::after,
        label:has(+ select[required])::after {
            content: " *";
            color: #ef4444; /* text-red-500 */
        }

        /* Animación suave para los radio buttons personalizados */
        input[type="radio"]:checked + label {
            transform: scale(1.02);
        }

        input[type="radio"] + label {
            transition: all 0.2s ease;
        }
    </style>
    @endpush
</x-admin-layout>