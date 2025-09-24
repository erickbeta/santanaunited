{{-- resources/views/admin/games/edit.blade.php --}}
<x-admin-layout title="Editar Partido">
    <div class="container mx-auto px-4 max-w-4xl">
        
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Editar Partido</h1>
                <p class="text-gray-600 mt-1">{{ $game->opponent }} - {{ $game->game_date->format('d/m/Y H:i') }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.games.show', $game) }}" 
                   class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-eye mr-2"></i>Ver
                </a>
                <a href="{{ route('admin.games.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Volver
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow">
            {{-- Pestañas de navegación --}}
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8 px-6">
                    <button type="button" class="tab-button border-b-2 border-blue-500 text-blue-600 py-4 px-1 text-sm font-medium" data-tab="basic">
                        <i class="fas fa-info-circle mr-2"></i>Información Básica
                    </button>
                    @if($game->game_date < now())
                        <button type="button" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium" data-tab="result">
                            <i class="fas fa-futbol mr-2"></i>Resultado
                        </button>
                    @endif
                    <button type="button" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium" data-tab="additional">
                        <i class="fas fa-cog mr-2"></i>Configuración
                    </button>
                </nav>
            </div>

            <form action="{{ route('admin.games.update', $game) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                {{-- Pestaña: Información Básica --}}
                <div id="basic-tab" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="opponent" class="block text-sm font-medium text-gray-700 mb-2">Equipo Oponente *</label>
                            <input type="text" name="opponent" id="opponent" required
                                   value="{{ old('opponent', $game->opponent) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('opponent') border-red-500 @enderror"
                                   placeholder="Nombre del equipo rival">
                            @error('opponent')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Partido *</label>
                            <select name="type" id="type" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror">
                                <option value="">Seleccionar...</option>
                                <option value="local" {{ old('type', $game->type) === 'local' ? 'selected' : '' }}>Local</option>
                                <option value="visitante" {{ old('type', $game->type) === 'visitante' ? 'selected' : '' }}>Visitante</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="game_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha y Hora *</label>
                            <input type="datetime-local" name="game_date" id="game_date" required
                                   value="{{ old('game_date', $game->game_date->format('Y-m-d\TH:i')) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('game_date') border-red-500 @enderror">
                            @error('game_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Ubicación *</label>
                            <input type="text" name="location" id="location" required
                                   value="{{ old('location', $game->location) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @enderror"
                                   placeholder="Estadio o cancha"
                                   list="location-suggestions">
                            
                            <datalist id="location-suggestions">
                                <option value="Estadio Principal">
                                <option value="Campo Municipal">
                                <option value="Cancha Norte">
                                <option value="Polideportivo Central">
                                <option value="Campo de Entrenamiento">
                            </datalist>
                            
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="competition" class="block text-sm font-medium text-gray-700 mb-2">Competición *</label>
                            <input type="text" name="competition" id="competition" required
                                   value="{{ old('competition', $game->competition) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('competition') border-red-500 @enderror"
                                   placeholder="Liga Regional, Copa Municipal, etc."
                                   list="competition-suggestions">
                            
                            <datalist id="competition-suggestions">
                                <option value="Liga Regional">
                                <option value="Copa Municipal">
                                <option value="Torneo Clausura">
                                <option value="Torneo Apertura">
                                <option value="Copa de Campeones">
                                <option value="Amistoso">
                            </datalist>
                            
                            @error('competition')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="ticket_price" class="block text-sm font-medium text-gray-700 mb-2">Precio Entrada</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">$</span>
                                <input type="number" name="ticket_price" id="ticket_price" step="0.01" min="0"
                                       value="{{ old('ticket_price', $game->ticket_price) }}"
                                       class="w-full border border-gray-300 rounded-lg pl-8 pr-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('ticket_price') border-red-500 @enderror"
                                       placeholder="0.00">
                            </div>
                            @error('ticket_price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="ticket_url" class="block text-sm font-medium text-gray-700 mb-2">URL de Venta de Entradas</label>
                            <input type="url" name="ticket_url" id="ticket_url"
                                   value="{{ old('ticket_url', $game->ticket_url) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('ticket_url') border-red-500 @enderror"
                                   placeholder="https://ejemplo.com/entradas">
                            @error('ticket_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descripción del Partido</label>
                            <textarea name="description" id="description" rows="3"
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror resize-none"
                                      placeholder="Información adicional sobre el partido...">{{ old('description', $game->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Vista previa --}}
                    <div class="mt-8 p-4 bg-gray-50 rounded-lg border">
                        <h4 class="text-md font-medium text-gray-900 mb-3">Vista Previa</h4>
                        <div id="game-preview" class="text-sm text-gray-700">
                            <p class="mb-1">
                                <span class="font-medium">Partido:</span> 
                                <span id="preview-matchup">{{ $game->type === 'local' ? 'Santana United vs ' . $game->opponent : $game->opponent . ' vs Santana United' }}</span>
                            </p>
                            <p class="mb-1">
                                <span class="font-medium">Fecha:</span> 
                                <span id="preview-date">{{ $game->game_date->format('d/m/Y H:i') }}</span>
                            </p>
                            <p class="mb-1">
                                <span class="font-medium">Ubicación:</span> 
                                <span id="preview-location">{{ $game->location }}</span>
                            </p>
                            <p>
                                <span class="font-medium">Competición:</span> 
                                <span id="preview-competition">{{ $game->competition }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Pestaña: Resultado (solo si el partido ya terminó) --}}
                @if($game->game_date < now())
                    <div id="result-tab" class="tab-content hidden">
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Resultado del Partido</h3>
                            
                            @if($game->score_local !== null && $game->away_team_score !== null)
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                                    <div class="flex items-center">
                                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                        <p class="text-blue-800">
                                            Este partido ya tiene un resultado registrado. Puedes modificarlo si es necesario.
                                        </p>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="score_local" class="block text-sm font-medium text-gray-700 mb-2">
                                        Goles Equipo Local
                                        <span class="text-xs text-gray-500">({{ $game->type === 'local' ? 'Santana United' : $game->opponent }})</span>
                                    </label>
                                    <input type="number" name="score_local" id="score_local" min="0" max="50"
                                           value="{{ old('score_local', $game->score_local) }}"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent @error('score_local') border-red-500 @enderror">
                                    @error('score_local')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="away_team_score" class="block text-sm font-medium text-gray-700 mb-2">
                                        Goles Equipo Visitante
                                        <span class="text-xs text-gray-500">({{ $game->type === 'visitante' ? 'Santana United' : $game->opponent }})</span>
                                    </label>
                                    <input type="number" name="away_team_score" id="away_team_score" min="0" max="50"
                                           value="{{ old('away_team_score', $game->away_team_score) }}"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent @error('away_team_score') border-red-500 @enderror">
                                    @error('away_team_score')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex items-end">
                                    <div class="w-full">
                                        <p class="text-sm font-medium text-gray-700 mb-2">Resultado</p>
                                        <div id="result-indicator" class="w-full p-3 rounded-lg border text-center">
                                            <span id="result-text" class="font-medium">Ingresa los goles</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-3">
                                    <label for="match_report" class="block text-sm font-medium text-gray-700 mb-2">Reporte del Partido</label>
                                    <textarea name="match_report" id="match_report" rows="5"
                                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent @error('match_report') border-red-500 @enderror"
                                              placeholder="Resumen del partido, jugadores destacados, incidentes importantes...">{{ old('match_report', $game->match_report) }}</textarea>
                                    <p class="mt-1 text-xs text-gray-500">Este reporte será visible en la página del partido</p>
                                    @error('match_report')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Pestaña: Configuración Adicional --}}
                <div id="additional-tab" class="tab-content hidden">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Estado del Partido</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 border rounded-lg">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900">Estado de Visibilidad</h4>
                                        <p class="text-sm text-gray-500">
                                            {{ $game->is_active ? 'El partido está visible para los usuarios' : 'El partido está oculto para los usuarios' }}
                                        </p>
                                    </div>
                                    <div class="flex items-center">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="hidden" name="is_active" value="0">
                                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $game->is_active) ? 'checked' : '' }} 
                                                   class="sr-only peer" id="is_active_toggle">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="p-4 border rounded-lg bg-gray-50">
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Información del Sistema</h4>
                                    <dl class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <dt class="font-medium text-gray-500">ID del Partido:</dt>
                                            <dd class="text-gray-900">#{{ $game->id }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-medium text-gray-500">Creado:</dt>
                                            <dd class="text-gray-900">{{ $game->created_at->format('d/m/Y H:i') }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-medium text-gray-500">Última actualización:</dt>
                                            <dd class="text-gray-900">{{ $game->updated_at->format('d/m/Y H:i') }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-medium text-gray-500">Estado:</dt>
                                            <dd>
                                                @if($game->game_date > now())
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Próximo
                                                    </span>
                                                @elseif($game->score_local !== null)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Finalizado
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                        Sin resultado
                                                    </span>
                                                @endif
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Acciones Rápidas</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="p-4 border rounded-lg">
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Duplicar Partido</h4>
                                    <p class="text-sm text-gray-500 mb-3">Crea una copia de este partido para la próxima fecha</p>
                                    <button type="button" onclick="duplicateGame()" 
                                            class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm">
                                        <i class="fas fa-copy mr-2"></i>Duplicar
                                    </button>
                                </div>

                                <div class="p-4 border rounded-lg">
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Ver Partido</h4>
                                    <p class="text-sm text-gray-500 mb-3">Ver cómo se muestra este partido a los usuarios</p>
                                    <a href="{{ route('admin.games.show', $game) }}" 
                                       class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-sm">
                                        <i class="fas fa-eye mr-2"></i>Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botones de acción --}}
                <div class="mt-8 flex justify-between border-t pt-6">
                    <div class="flex space-x-2">
                        <button type="button" onclick="confirmDelete()" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                            <i class="fas fa-trash mr-2"></i>Eliminar Partido
                        </button>
                    </div>
                    
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.games.index') }}" 
                           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-save mr-2"></i>Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del formulario
            const opponentInput = document.getElementById('opponent');
            const typeSelect = document.getElementById('type');
            const dateInput = document.getElementById('game_date');
            const locationInput = document.getElementById('location');
            const competitionInput = document.getElementById('competition');
            
            // Elementos de resultado
            const scoreLocalInput = document.getElementById('score_local');
            const awayScoreInput = document.getElementById('away_team_score');
            const resultIndicator = document.getElementById('result-indicator');
            const resultText = document.getElementById('result-text');
            
            // Elementos de vista previa
            const previewMatchup = document.getElementById('preview-matchup');
            const previewDate = document.getElementById('preview-date');
            const previewLocation = document.getElementById('preview-location');
            const previewCompetition = document.getElementById('preview-competition');

            // Manejo de pestañas
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetTab = this.dataset.tab;
                    
                    // Actualizar botones
                    tabButtons.forEach(btn => {
                        btn.classList.remove('border-blue-500', 'text-blue-600');
                        btn.classList.add('border-transparent', 'text-gray-500');
                    });
                    this.classList.remove('border-transparent', 'text-gray-500');
                    this.classList.add('border-blue-500', 'text-blue-600');
                    
                    // Actualizar contenido
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    document.getElementById(targetTab + '-tab').classList.remove('hidden');
                });
            });

            // Función para actualizar vista previa
            function updatePreview() {
                const opponent = opponentInput.value || '{{ $game->opponent }}';
                const type = typeSelect.value || '{{ $game->type }}';
                
                if (type === 'local') {
                    previewMatchup.textContent = `Santana United vs ${opponent}`;
                } else if (type === 'visitante') {
                    previewMatchup.textContent = `${opponent} vs Santana United`;
                }
                
                if (dateInput.value) {
                    const date = new Date(dateInput.value);
                    const options = { 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric', 
                        hour: '2-digit', 
                        minute: '2-digit' 
                    };
                    previewDate.textContent = date.toLocaleDateString('es-ES', options);
                }
                
                previewLocation.textContent = locationInput.value || '{{ $game->location }}';
                previewCompetition.textContent = competitionInput.value || '{{ $game->competition }}';
            }

            // Función para actualizar indicador de resultado
            function updateResultIndicator() {
                if (scoreLocalInput && awayScoreInput && resultIndicator && resultText) {
                    const localScore = parseInt(scoreLocalInput.value);
                    const awayScore = parseInt(awayScoreInput.value);
                    const gameType = '{{ $game->type }}';
                    
                    if (isNaN(localScore) || isNaN(awayScore)) {
                        resultText.textContent = 'Ingresa los goles';
                        resultIndicator.className = 'w-full p-3 rounded-lg border text-center bg-gray-50';
                        return;
                    }
                    
                    let result, resultClass;
                    
                    if (localScore === awayScore) {
                        result = 'EMPATE';
                        resultClass = 'w-full p-3 rounded-lg border text-center bg-yellow-100 border-yellow-300 text-yellow-800';
                    } else if (
                        (gameType === 'local' && localScore > awayScore) || 
                        (gameType === 'visitante' && awayScore > localScore)
                    ) {
                        result = 'VICTORIA';
                        resultClass = 'w-full p-3 rounded-lg border text-center bg-green-100 border-green-300 text-green-800';
                    } else {
                        result = 'DERROTA';
                        resultClass = 'w-full p-3 rounded-lg border text-center bg-red-100 border-red-300 text-red-800';
                    }
                    
                    resultText.textContent = result;
                    resultIndicator.className = resultClass;
                }
            }

            // Event listeners
            [opponentInput, typeSelect, dateInput, locationInput, competitionInput].forEach(input => {
                if (input) {
                    input.addEventListener('input', updatePreview);
                    input.addEventListener('change', updatePreview);
                }
            });

            if (scoreLocalInput && awayScoreInput) {
                scoreLocalInput.addEventListener('input', updateResultIndicator);
                awayScoreInput.addEventListener('input', updateResultIndicator);
                // Actualizar al cargar
                updateResultIndicator();
            }
        });

        // Función para duplicar partido
        function duplicateGame() {
            if (confirm('¿Deseas crear una copia de este partido? Se abrirá en una nueva ventana para que puedas editarla.')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.games.duplicate", $game) }}';
                form.target = '_blank';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            }
        }

        // Función para confirmar eliminación
        function confirmDelete() {
            if (confirm('¿Estás seguro de que deseas eliminar este partido?\n\nEsta acción no se puede deshacer y eliminará:\n- El partido\n- Su resultado (si existe)\n- Toda la información relacionada')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.games.destroy", $game) }}';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            }
        }

        // Validación del formulario
        document.querySelector('form').addEventListener('submit', function(e) {
            const requiredFields = [opponentInput, typeSelect, dateInput, locationInput, competitionInput];
            let hasErrors = false;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    hasErrors = true;
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            // Validar que si hay resultado, ambos campos estén completos
            if (scoreLocalInput && awayScoreInput) {
                const hasLocalScore = scoreLocalInput.value !== '';
                const hasAwayScore = awayScoreInput.value !== '';
                
                if (hasLocalScore !== hasAwayScore) {
                    if (!hasLocalScore) scoreLocalInput.classList.add('border-red-500');
                    if (!hasAwayScore) awayScoreInput.classList.add('border-red-500');
                    hasErrors = true;
                    alert('Si ingresas un resultado, debes completar ambos campos de goles.');
                }
            }

            if (hasErrors) {
                e.preventDefault();
                // Cambiar a la pestaña con errores
                if (document.querySelector('.border-red-500')) {
                    const errorField = document.querySelector('.border-red-500');
                    const tabContent = errorField.closest('.tab-content');
                    if (tabContent) {
                        const tabId = tabContent.id.replace('-tab', '');
                        const tabButton = document.querySelector(`[data-tab="${tabId}"]`);
                        if (tabButton) {
                            tabButton.click();
                        }
                    }
                }
                alert('Por favor revisa los campos marcados en rojo.');
            }
        });
    </script>
    @endpush

    @push('styles')
    <style>
        /* Mejoras visuales para las pestañas */
        .tab-button {
            transition: all 0.2s ease;
        }
        
        .tab-button:hover {
            border-color: #d1d5db;
        }

        .tab-content {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Mejorar el enfoque de los campos */
        .focus\:ring-2:focus {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        /* Estilo para campos con error */
        .border-red-500:focus {
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.5);
        }

        /* Estilo para el toggle switch */
        .peer:checked ~ .peer-checked\:bg-blue-600 {
            background-color: #2563eb;
        }

        /* Animación suave para la vista previa y resultado */
        #game-preview, #result-indicator {
            transition: all 0.3s ease;
        }

        /* Indicador visual para campos requeridos */
        label:has(~ input[required])::after,
        label:has(~ select[required])::after {
            content: " *";
            color: #ef4444;
        }

        /* Mejorar la apariencia de los números de resultado */
        #score_local, #away_team_score {
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
        }

        /* Estilo para el resultado destacado */
        #result-indicator {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.05em;
        }
    </style>
    @endpush
</x-admin-layout>