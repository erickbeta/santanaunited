{{-- resources/views/admin/games/show.blade.php --}}
<x-admin-layout title="Detalles del Partido">
    <div class="container mx-auto px-4 max-w-6xl">
        
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Detalles del Partido</h1>
                <div class="flex items-center mt-2 space-x-4">
                    @if($game->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Activo
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-1"></i>Inactivo
                        </span>
                    @endif
                    
                    @if($game->type === 'local')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-home mr-1"></i>Local
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                            <i class="fas fa-plane mr-1"></i>Visitante
                        </span>
                    @endif

                    @if($game->game_date > now())
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            <i class="fas fa-clock mr-1"></i>Próximo
                        </span>
                    @elseif($game->score_local !== null)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            <i class="fas fa-flag-checkered mr-1"></i>Finalizado
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-exclamation-triangle mr-1"></i>Sin resultado
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="flex space-x-2">
                <a href="{{ route('admin.games.edit', $game) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-edit mr-2"></i>Editar
                </a>
                <a href="{{ route('admin.games.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Volver
                </a>
            </div>
        </div>

        {{-- Información principal del partido --}}
        <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-6">
                <div class="text-center">
                    <h2 class="text-2xl md:text-3xl font-bold mb-2">
                        @if($game->type === 'local')
                            Santana United <span class="text-blue-200">vs</span> {{ $game->opponent }}
                        @else
                            {{ $game->opponent }} <span class="text-blue-200">vs</span> Santana United
                        @endif
                    </h2>
                    <p class="text-blue-100 text-lg">
                        {{ $game->game_date->format('l, d \d\e F \d\e Y') }} - {{ $game->game_date->format('H:i') }}
                    </p>
                    <p class="text-blue-200">
                        <i class="fas fa-map-marker-alt mr-1"></i>{{ $game->location }}
                    </p>
                </div>
            </div>

            {{-- Resultado o contador regresivo --}}
            <div class="p-6 bg-gray-50">
                @if($game->score_local !== null && $game->away_team_score !== null)
                    {{-- Mostrar resultado --}}
                    <div class="text-center">
                        <div class="text-5xl md:text-6xl font-bold text-gray-900 mb-4">
                            {{ $game->score_local }} - {{ $game->away_team_score }}
                        </div>
                        
                        @php
                            $result = '';
                            $resultClass = '';
                            $resultIcon = '';
                            $myTeamId = 1; // Ajustar según tu configuración
                            
                            if ($game->score_local === $game->away_team_score) {
                                $result = 'EMPATE';
                                $resultClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                $resultIcon = 'fas fa-handshake';
                            } elseif (
                                ($game->type === 'local' && $game->score_local > $game->away_team_score) || 
                                ($game->type === 'visitante' && $game->away_team_score > $game->score_local)
                            ) {
                                $result = 'VICTORIA';
                                $resultClass = 'bg-green-100 text-green-800 border-green-200';
                                $resultIcon = 'fas fa-trophy';
                            } else {
                                $result = 'DERROTA';
                                $resultClass = 'bg-red-100 text-red-800 border-red-200';
                                $resultIcon = 'fas fa-times-circle';
                            }
                        @endphp
                        
                        <div class="inline-flex items-center px-6 py-3 rounded-full text-xl font-bold border-2 {{ $resultClass }}">
                            <i class="{{ $resultIcon }} mr-3"></i>
                            {{ $result }}
                        </div>
                    </div>
                @elseif($game->game_date < now())
                    {{-- Partido terminado sin resultado --}}
                    <div class="text-center py-8">
                        <i class="fas fa-clock text-5xl text-orange-400 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Partido Finalizado</h3>
                        <p class="text-gray-600 mb-4">No se ha registrado el resultado de este partido</p>
                        <a href="{{ route('admin.games.edit', $game) }}" 
                           class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>Agregar Resultado
                        </a>
                    </div>
                @else
                    {{-- Contador regresivo para partido próximo --}}
                    <div class="text-center py-8">
                        <i class="fas fa-calendar-plus text-5xl text-blue-400 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Partido Próximo</h3>
                        <div id="countdown" class="text-2xl font-mono text-blue-600 mb-4">
                            {{-- Se llenará con JavaScript --}}
                        </div>
                        <p class="text-gray-600">
                            {{ $game->game_date->diffForHumans() }}
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Información detallada --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Detalles del partido --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>Información del Partido
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <dt class="text-sm font-medium text-gray-500 w-24">Oponente:</dt>
                                <dd class="text-sm text-gray-900 font-semibold">{{ $game->opponent }}</dd>
                            </div>
                            
                            <div class="flex items-start">
                                <dt class="text-sm font-medium text-gray-500 w-24">Fecha:</dt>
                                <dd class="text-sm text-gray-900">{{ $game->game_date->format('d/m/Y') }}</dd>
                            </div>
                            
                            <div class="flex items-start">
                                <dt class="text-sm font-medium text-gray-500 w-24">Hora:</dt>
                                <dd class="text-sm text-gray-900">{{ $game->game_date->format('H:i') }}</dd>
                            </div>

                            <div class="flex items-start">
                                <dt class="text-sm font-medium text-gray-500 w-24">Tipo:</dt>
                                <dd class="text-sm text-gray-900">
                                    @if($game->type === 'local')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-home mr-1"></i>Local
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            <i class="fas fa-plane mr-1"></i>Visitante
                                        </span>
                                    @endif
                                </dd>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-start">
                                <dt class="text-sm font-medium text-gray-500 w-28">Ubicación:</dt>
                                <dd class="text-sm text-gray-900">
                                    <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                                    {{ $game->location }}
                                </dd>
                            </div>
                            
                            <div class="flex items-start">
                                <dt class="text-sm font-medium text-gray-500 w-28">Competición:</dt>
                                <dd class="text-sm text-gray-900">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $game->competition }}
                                    </span>
                                </dd>
                            </div>
                            
                            @if($game->ticket_price)
                                <div class="flex items-start">
                                    <dt class="text-sm font-medium text-gray-500 w-28">Entrada:</dt>
                                    <dd class="text-sm text-gray-900 font-semibold">
                                        ${{ number_format($game->ticket_price, 2) }}
                                    </dd>
                                </div>
                            @endif

                            @if($game->ticket_url)
                                <div class="flex items-start">
                                    <dt class="text-sm font-medium text-gray-500 w-28">Entradas:</dt>
                                    <dd class="text-sm">
                                        <a href="{{ $game->ticket_url }}" target="_blank" 
                                           class="text-blue-600 hover:text-blue-800 font-medium">
                                            <i class="fas fa-external-link-alt mr-1"></i>Comprar
                                        </a>
                                    </dd>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    @if($game->description)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <dt class="text-sm font-medium text-gray-500 mb-3">Descripción:</dt>
                            <dd class="text-gray-900 bg-gray-50 p-4 rounded-lg leading-relaxed">
                                {!! nl2br(e($game->description)) !!}
                            </dd>
                        </div>
                    @endif
                </div>

                {{-- Reporte del partido (si existe) --}}
                @if($game->match_report)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">
                            <i class="fas fa-file-alt text-green-500 mr-2"></i>Reporte del Partido
                        </h3>
                        <div class="prose prose-sm max-w-none">
                            <div class="text-gray-900 bg-gray-50 p-4 rounded-lg leading-relaxed">
                                {!! nl2br(e($game->match_report)) !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Acciones rápidas --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-tools text-purple-500 mr-2"></i>Acciones
                    </h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('admin.games.edit', $game) }}" 
                           class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-edit mr-2"></i>Editar Partido
                        </a>

                        @if($game->game_date < now() && $game->score_local === null)
                            <button type="button" onclick="openQuickScoreModal()" 
                                    class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fas fa-plus-circle mr-2"></i>Agregar Resultado
                            </button>
                        @endif
                        
                        <form action="{{ route('admin.games.duplicate', $game) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center justify-center px-4 py-2 border border-purple-300 text-purple-700 rounded-lg hover:bg-purple-50 transition-colors">
                                <i class="fas fa-copy mr-2"></i>Duplicar Partido
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.games.toggle-status', $game) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center justify-center px-4 py-2 border rounded-lg transition-colors {{ $game->is_active ? 'border-orange-300 text-orange-700 hover:bg-orange-50' : 'border-green-300 text-green-700 hover:bg-green-50' }}">
                                @if($game->is_active)
                                    <i class="fas fa-eye-slash mr-2"></i>Desactivar
                                @else
                                    <i class="fas fa-eye mr-2"></i>Activar
                                @endif
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.games.destroy', $game) }}" method="POST" 
                              onsubmit="return confirm('¿Estás seguro de eliminar este partido? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full flex items-center justify-center px-4 py-2 border border-red-300 text-red-700 rounded-lg hover:bg-red-50 transition-colors">
                                <i class="fas fa-trash mr-2"></i>Eliminar
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Información del sistema --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-database text-gray-500 mr-2"></i>Información del Sistema
                    </h3>
                    
                    <dl class="space-y-3 text-sm">
                        <div>
                            <dt class="font-medium text-gray-500">ID del Partido:</dt>
                            <dd class="text-gray-900 font-mono">#{{ $game->id }}</dd>
                        </div>
                        
                        <div>
                            <dt class="font-medium text-gray-500">Creado:</dt>
                            <dd class="text-gray-900">{{ $game->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        
                        <div>
                            <dt class="font-medium text-gray-500">Actualizado:</dt>
                            <dd class="text-gray-900">{{ $game->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        
                        @if($game->creator)
                            <div>
                                <dt class="font-medium text-gray-500">Creado por:</dt>
                                <dd class="text-gray-900">{{ $game->creator->name }}</dd>
                            </div>
                        @endif

                        <div class="pt-3 border-t border-gray-200">
                            <dt class="font-medium text-gray-500">Estado actual:</dt>
                            <dd class="text-gray-900 mt-1">
                                @if($game->game_date > now())
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-clock mr-1"></i>Próximo
                                    </span>
                                @elseif($game->score_local !== null)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>Completado
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                        <i class="fas fa-exclamation mr-1"></i>Pendiente
                                    </span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>

                {{-- Estadísticas rápidas --}}
                @if($game->score_local !== null && $game->away_team_score !== null)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-chart-bar text-indigo-500 mr-2"></i>Estadísticas
                        </h3>
                        
                        <dl class="space-y-3 text-sm">
                            <div>
                                <dt class="font-medium text-gray-500">Total de goles:</dt>
                                <dd class="text-2xl font-bold text-gray-900">{{ $game->score_local + $game->away_team_score }}</dd>
                            </div>
                            
                            <div>
                                <dt class="font-medium text-gray-500">Goles nuestro equipo:</dt>
                                <dd class="text-xl font-semibold text-blue-600">
                                    {{ $game->type === 'local' ? $game->score_local : $game->away_team_score }}
                                </dd>
                            </div>
                            
                            <div>
                                <dt class="font-medium text-gray-500">Goles rival:</dt>
                                <dd class="text-xl font-semibold text-red-600">
                                    {{ $game->type === 'local' ? $game->away_team_score : $game->score_local }}
                                </dd>
                            </div>

                            <div class="pt-3 border-t border-gray-200">
                                <dt class="font-medium text-gray-500">Diferencia:</dt>
                                <dd class="text-lg font-bold">
                                    @php
                                        $ourGoals = $game->type === 'local' ? $game->score_local : $game->away_team_score;
                                        $theirGoals = $game->type === 'local' ? $game->away_team_score : $game->score_local;
                                        $difference = $ourGoals - $theirGoals;
                                    @endphp
                                    
                                    @if($difference > 0)
                                        <span class="text-green-600">+{{ $difference }}</span>
                                    @elseif($difference < 0)
                                        <span class="text-red-600">{{ $difference }}</span>
                                    @else
                                        <span class="text-gray-600">0</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal para resultado rápido --}}
    @if($game->game_date < now() && $game->score_local === null)
        <div id="quickScoreModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route('admin.games.update-score', $game) }}" method="POST">
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Actualizar Resultado</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Goles Local
                                        <span class="text-xs text-gray-500 block">({{ $game->type === 'local' ? 'Santana United' : $game->opponent }})</span>
                                    </label>
                                    <input type="number" name="score_local" min="0" required
                                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-center text-lg font-semibold focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Goles Visitante
                                        <span class="text-xs text-gray-500 block">({{ $game->type === 'visitante' ? 'Santana United' : $game->opponent }})</span>
                                    </label>
                                    <input type="number" name="away_team_score" min="0" required
                                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-center text-lg font-semibold focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" 
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Guardar Resultado
                            </button>
                            <button type="button" 
                                    onclick="closeQuickScoreModal()"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Contador regresivo para partidos próximos
            @if($game->game_date > now())
                function updateCountdown() {
                    const gameDate = new Date('{{ $game->game_date->toISOString() }}');
                    const now = new Date();
                    const diff = gameDate - now;

                    if (diff > 0) {
                        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                        const countdownElement = document.getElementById('countdown');
                        if (countdownElement) {
                            countdownElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                        }
                    } else {
                        const countdownElement = document.getElementById('countdown');
                        if (countdownElement) {
                            countdownElement.innerHTML = '¡El partido ha comenzado!';
                        }
                    }
                }

                // Actualizar cada segundo
                updateCountdown();
                setInterval(updateCountdown, 1000);
            @endif
        });

        // Funciones para el modal de resultado rápido
        function openQuickScoreModal() {
            document.getElementById('quickScoreModal').classList.remove('hidden');
        }

        function closeQuickScoreModal() {
            document.getElementById('quickScoreModal').classList.add('hidden');
        }

        // Cerrar modal al hacer click fuera
        document.getElementById('quickScoreModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeQuickScoreModal();
            }
        });
    </script>
    @endpush

    @push('styles')
    <style>
        .prose {
            max-width: none;
        }
        
        /* Animaciones suaves */
        .transition-colors {
            transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out;
        }

        /* Estilo para el contador regresivo */
        #countdown {
            font-family: 'Courier New', monospace;
            letter-spacing: 0.05em;
        }

        /* Mejorar el contraste de los badges */
        .bg-blue-100 { background-color: #dbeafe; }
        .bg-green-100 { background-color: #dcfce7; }
        .bg-yellow-100 { background-color: #fef3c7; }
        .bg-orange-100 { background-color: #fed7aa; }
        .bg-red-100 { background-color: #fee2e2; }
        .bg-purple-100 { background-color: #f3e8ff; }
        .bg-indigo-100 { background-color: #e0e7ff; }
    </style>
    @endpush
</x-admin-layout>