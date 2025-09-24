{{-- resources/views/admin/games/create.blade.php --}}
<x-admin-layout title="Crear Nuevo Partido">
    <div class="container mx-auto px-4 max-w-4xl">
        
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Crear Nuevo Partido</h1>
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
                    
                    <div>
                        <label for="opponent" class="block text-sm font-medium text-gray-700 mb-2">Equipo Oponente *</label>
                        <input type="text" name="opponent" id="opponent" required
                               value="{{ old('opponent') }}"
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
                            <option value="local" {{ old('type') === 'local' ? 'selected' : '' }}>Local</option>
                            <option value="visitante" {{ old('type') === 'visitante' ? 'selected' : '' }}>Visitante</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="game_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha y Hora *</label>
                        <input type="datetime-local" name="game_date" id="game_date" required
                               value="{{ old('game_date') }}"
                               min="{{ date('Y-m-d\TH:i') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('game_date') border-red-500 @enderror">
                        @error('game_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Ubicación *</label>
                        <input type="text" name="location" id="location" required
                               value="{{ old('location') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @enderror"
                               placeholder="Estadio o cancha donde se jugará"
                               list="location-suggestions">
                        
                        {{-- Sugerencias comunes de ubicaciones --}}
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
                               value="{{ old('competition') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('competition') border-red-500 @enderror"
                               placeholder="Liga Regional, Copa Municipal, etc."
                               list="competition-suggestions">
                        
                        {{-- Sugerencias comunes de competiciones --}}
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

                    {{-- Información adicional --}}
                    <div class="md:col-span-2 mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información Adicional (Opcional)</h3>
                    </div>

                    <div>
                        <label for="ticket_price" class="block text-sm font-medium text-gray-700 mb-2">Precio Entrada</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                            <input type="number" name="ticket_price" id="ticket_price" step="0.01" min="0"
                                   value="{{ old('ticket_price') }}"
                                   class="w-full border border-gray-300 rounded-lg pl-8 pr-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('ticket_price') border-red-500 @enderror"
                                   placeholder="0.00">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Dejar vacío si la entrada es gratuita</p>
                        @error('ticket_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="ticket_url" class="block text-sm font-medium text-gray-700 mb-2">URL de Venta de Entradas</label>
                        <input type="url" name="ticket_url" id="ticket_url"
                               value="{{ old('ticket_url') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('ticket_url') border-red-500 @enderror"
                               placeholder="https://ejemplo.com/entradas">
                        <p class="mt-1 text-xs text-gray-500">Enlace donde los fans pueden comprar entradas</p>
                        @error('ticket_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descripción del Partido</label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none @error('description') border-red-500 @enderror"
                                  placeholder="Información adicional sobre el partido, importancia, contexto, etc.">{{ old('description') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Información que será visible para los fans</p>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Vista previa del partido --}}
                <div class="mt-8 p-4 bg-gray-50 rounded-lg border">
                    <h4 class="text-md font-medium text-gray-900 mb-3">Vista Previa</h4>
                    <div id="game-preview" class="text-sm text-gray-700">
                        <p class="mb-1">
                            <span class="font-medium">Partido:</span> 
                            <span id="preview-matchup">Selecciona oponente y tipo de partido</span>
                        </p>
                        <p class="mb-1">
                            <span class="font-medium">Fecha:</span> 
                            <span id="preview-date">Selecciona fecha</span>
                        </p>
                        <p class="mb-1">
                            <span class="font-medium">Ubicación:</span> 
                            <span id="preview-location">Ingresa ubicación</span>
                        </p>
                        <p>
                            <span class="font-medium">Competición:</span> 
                            <span id="preview-competition">Ingresa competición</span>
                        </p>
                    </div>
                </div>

                {{-- Botones de acción --}}
                <div class="mt-8 flex justify-between">
                    <div>
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-info-circle mr-1"></i>
                            Los campos marcados con * son obligatorios
                        </p>
                    </div>
                    
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.games.index') }}" 
                           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                            <i class="fas fa-times mr-2"></i>Cancelar
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
            // Elementos del formulario
            const opponentInput = document.getElementById('opponent');
            const typeSelect = document.getElementById('type');
            const dateInput = document.getElementById('game_date');
            const locationInput = document.getElementById('location');
            const competitionInput = document.getElementById('competition');
            
            // Elementos de vista previa
            const previewMatchup = document.getElementById('preview-matchup');
            const previewDate = document.getElementById('preview-date');
            const previewLocation = document.getElementById('preview-location');
            const previewCompetition = document.getElementById('preview-competition');

            // Función para actualizar vista previa
            function updatePreview() {
                // Actualizar enfrentamiento
                const opponent = opponentInput.value.trim() || '[Oponente]';
                const type = typeSelect.value;
                
                if (type === 'local') {
                    previewMatchup.textContent = `Santana United vs ${opponent}`;
                } else if (type === 'visitante') {
                    previewMatchup.textContent = `${opponent} vs Santana United`;
                } else {
                    previewMatchup.textContent = 'Selecciona oponente y tipo de partido';
                }
                
                // Actualizar fecha
                if (dateInput.value) {
                    try {
                        const date = new Date(dateInput.value);
                        const options = { 
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
                
                // Actualizar ubicación
                previewLocation.textContent = locationInput.value.trim() || 'Ingresa ubicación';
                
                // Actualizar competición
                previewCompetition.textContent = competitionInput.value.trim() || 'Ingresa competición';
            }

            // Event listeners para actualizar vista previa
            if (opponentInput) opponentInput.addEventListener('input', updatePreview);
            if (typeSelect) typeSelect.addEventListener('change', updatePreview);
            if (dateInput) dateInput.addEventListener('input', updatePreview);
            if (locationInput) locationInput.addEventListener('input', updatePreview);
            if (competitionInput) competitionInput.addEventListener('input', updatePreview);

            // Establecer fecha mínima como ahora
            if (dateInput) {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const day = String(now.getDate()).padStart(2, '0');
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                
                dateInput.min = `${year}-${month}-${day}T${hours}:${minutes}`;
            }

            // Validación del formulario
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const requiredFields = [
                        opponentInput, 
                        typeSelect, 
                        dateInput, 
                        locationInput, 
                        competitionInput
                    ].filter(field => field !== null);
                    
                    let hasErrors = false;

                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            field.classList.add('border-red-500');
                            hasErrors = true;
                        } else {
                            field.classList.remove('border-red-500');
                        }
                    });

                    if (hasErrors) {
                        e.preventDefault();
                        alert('Por favor completa todos los campos obligatorios marcados en rojo.');
                        return false;
                    }

                    // Validar fecha
                    if (dateInput && dateInput.value) {
                        const selectedDate = new Date(dateInput.value);
                        const now = new Date();
                        
                        if (selectedDate <= now) {
                            e.preventDefault();
                            dateInput.classList.add('border-red-500');
                            alert('La fecha del partido debe ser futura.');
                            return false;
                        }
                    }

                    // Mostrar indicador de carga
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creando...';
                    }
                });
            }

            // Inicializar vista previa
            updatePreview();
        });
    </script>
    @endpush

    @push('styles')
    <style>
        /* Mejorar el enfoque de los campos */
        .focus\:ring-2:focus {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        /* Estilo para campos con error */
        .border-red-500:focus {
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.5);
        }

        /* Animación suave para la vista previa */
        #game-preview {
            transition: all 0.3s ease;
        }

        /* Mejorar la apariencia de los datalist */
        datalist {
            font-family: inherit;
        }

        /* Indicador visual para campos requeridos */
        label::after {
            content: "";
        }
        
        label:has(~ input[required])::after,
        label:has(~ select[required])::after {
            content: " *";
            color: #ef4444;
        }
    </style>
    @endpush
</x-admin-layout>