<x-admin-layout title="Editar Partido">
    <div class="container mx-auto px-4 max-w-4xl">
        
        {{-- CAMBIO: Título actualizado --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Editar Partido ⚽</h1>
            <a href="{{ route('admin.games.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Volver
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            {{-- CAMBIO: La acción del formulario apunta a la ruta 'update' y pasa el ID del partido --}}
            <form action="{{ route('admin.games.update', $game->id) }}" method="POST">
                @csrf
                {{-- CAMBIO: Se añade el método PUT para indicar que es una actualización --}}
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md-col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información del Partido</h3>
                    </div>
                    
                    {{-- CAMBIO: Los campos se precargan con los datos del partido existente ($game) --}}
                    
                    {{-- Campo para Equipo 1 (por convención, será el equipo local) --}}
                    <div>
                        <label for="team1_id" class="block text-sm font-medium text-gray-700 mb-2">Equipo 1</label>
                        <select name="team1_id" id="team1_id" required
                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('team1_id') border-red-500 @else border-gray-300 @enderror">
                            <option value="">Selecciona el primer equipo</option>
                            @foreach($teams as $team)
                                {{-- El helper old() prioriza el input del usuario si la validación falla; si no, usa el dato de la BD --}}
                                <option value="{{ $team->id }}" data-name="{{ $team->name }}" {{ old('team1_id', $game->home_team_id) == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('team1_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Campo para Equipo 2 (será el equipo visitante) --}}
                    <div>
                        <label for="team2_id" class="block text-sm font-medium text-gray-700 mb-2">Equipo 2</label>
                        <select name="team2_id" id="team2_id" required
                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('team2_id') border-red-500 @else border-gray-300 @enderror">
                            <option value="">Selecciona el segundo equipo</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}" data-name="{{ $team->name }}" {{ old('team2_id', $game->away_team_id) == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('team2_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Designar quién es el visitante --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Quién juega como visitante?</label>
                        <div class="flex items-center space-x-6">
                            {{-- Por defecto, "Equipo 2" (away_team) está marcado como visitante --}}
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="visitor_designation" id="visitor_team1" value="team1" {{ old('visitor_designation', 'team2') == 'team1' ? 'checked' : '' }} required>
                                <label class="form-check-label ml-2" for="visitor_team1">
                                    Equipo 1 será visitante
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="visitor_designation" id="visitor_team2" value="team2" {{ old('visitor_designation', 'team2') == 'team2' ? 'checked' : '' }}>
                                <label class="form-check-label ml-2" for="visitor_team2">
                                    Equipo 2 será visitante
                                </label>
                            </div>
                        </div>
                         @error('visitor_designation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="game_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha y Hora</label>
                        {{-- Se formatea la fecha para que el input datetime-local la pueda leer --}}
                        <input type="datetime-local" name="game_date" id="game_date" required
                               value="{{ old('game_date', $game->game_date->format('Y-m-d\TH:i')) }}"
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('game_date') border-red-500 @else border-gray-300 @enderror">
                        @error('game_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Ubicación</label>
                        <input type="text" name="location" id="location" required
                               value="{{ old('location', $game->location) }}"
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @else border-gray-300 @enderror"
                               placeholder="Estadio o cancha donde se jugará">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="competition" class="block text-sm font-medium text-gray-700 mb-2">Competición</label>
                        <input type="text" name="competition" id="competition" required
                               value="{{ old('competition', $game->competition) }}"
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('competition') border-red-500 @else border-gray-300 @enderror"
                               placeholder="Liga Regional, Copa Municipal, etc.">
                        @error('competition')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 p-4 bg-gray-50 rounded-lg border">
                    <h4 class="text-md font-medium text-gray-900 mb-3">Vista Previa</h4>
                    <div id="game-preview" class="text-sm text-gray-700">
                        {{-- El script se encargará de rellenar esto al cargar la página --}}
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.games.index') }}" 
                           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-save mr-2"></i>Actualizar Partido
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
            const team1Select = document.getElementById('team1_id');
            const team2Select = document.getElementById('team2_id');
            const visitorRadios = document.querySelectorAll('input[name="visitor_designation"]');
            const dateInput = document.getElementById('game_date');
            const competitionInput = document.getElementById('competition');
            const form = document.querySelector('form');
            
            // === Elementos de vista previa ===
            const previewMatchup = document.getElementById('preview-matchup');
            const previewDate = document.getElementById('preview-date');
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
                const team1Name = getSelectedText(team1Select) || '[Equipo 1]';
                const team2Name = getSelectedText(team2Select) || '[Equipo 2]';
                const visitor = document.querySelector('input[name="visitor_designation"]:checked')?.value;
                
                let matchupText = 'Selecciona los equipos y quién es visitante';
                if(team1Select.value && team2Select.value && visitor) {
                    if (visitor === 'team1') {
                        matchupText = `${team2Name} (L) vs ${team1Name} (V)`;
                    } else {
                        matchupText = `${team1Name} (L) vs ${team2Name} (V)`;
                    }
                }
                previewMatchup.textContent = matchupText;

                // 2. Actualizar fecha
                if (dateInput.value) {
                    try {
                        const date = new Date(dateInput.value);
                        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
                        previewDate.textContent = date.toLocaleDateString('es-ES', options);
                    } catch (e) {
                        previewDate.textContent = 'Fecha inválida';
                    }
                } else {
                    previewDate.textContent = 'Selecciona fecha';
                }
                
                // 3. Actualizar competición
                previewCompetition.textContent = competitionInput.value.trim() || 'Ingresa competición';
            }

            // === Event listeners para actualizar vista previa ===
            team1Select.addEventListener('change', updatePreview);
            team2Select.addEventListener('change', updatePreview);
            visitorRadios.forEach(radio => radio.addEventListener('change', updatePreview));
            dateInput.addEventListener('input', updatePreview);
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


</x-admin-layout>