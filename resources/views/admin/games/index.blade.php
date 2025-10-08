<x-admin-layout title="Gestión de Partidos">
    <div class="container mx-auto px-4">
        
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Partidos</h1>
            <div class="flex space-x-2">
                <a href="#" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-download mr-2"></i>Exportar
                </a>
                <a href="{{ route('admin.games.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-plus mr-2"></i>Nuevo Partido
                </a>
            </div>
        </div>
        
        {{-- Estadísticas --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <i class="fas fa-futbol text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Total Partidos</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['total_games'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-calendar-plus text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Próximos</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['upcoming_games'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <i class="fas fa-check-circle text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Finalizados</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['finished_games'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="p-2 bg-orange-100 rounded-lg">
                        <i class="fas fa-clock text-orange-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Sin Resultado</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['pending_results'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filtros --}}
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form method="GET" action="{{ route('admin.games.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Todos</option>
                        <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Próximos</option>
                        <option value="finished" {{ request('status') === 'finished' ? 'selected' : '' }}>Finalizados</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Competición</label>
                    <input type="text" name="competition" value="{{ request('competition') }}" 
                           placeholder="Liga, Copa..." 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Ubicación..." 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div class="flex items-end space-x-2">
                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-search mr-2"></i>Filtrar
                    </button>
                    <a href="{{ route('admin.games.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-times mr-2"></i>Limpiar
                    </a>
                </div>
            </form>
        </div>

        {{-- Lista de partidos --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Partido</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Competición</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resultado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($games as $game)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div>
                                        <div class="font-medium">{{ $game->game_date->format('d/m/Y') }}</div>
                                        <div class="text-gray-500">{{ $game->game_date->format('H:i') }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $game->homeTeam->name }} vs {{ $game->awayTeam->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $game->location }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $game->competition }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($game->score_local !== null && $game->score_visitor !== null)
                                        <span class="font-bold text-lg">{{ $game->score_local }} - {{ $game->score_visitor }}</span>
                                        @php
                                            // Determinar si Santa Ana ganó
                                            $santanaScore = ($game->home_team_id === $game->team1_id) ? $game->score_local : $game->score_visitor;
                                            $rivalScore = ($game->home_team_id === $game->team1_id) ? $game->score_visitor : $game->score_local;
                                            
                                            if ($santanaScore > $rivalScore) {
                                                $result = 'Victoria';
                                                $resultClass = 'text-green-600';
                                            } elseif ($santanaScore === $rivalScore) {
                                                $result = 'Empate';
                                                $resultClass = 'text-yellow-600';
                                            } else {
                                                $result = 'Derrota';
                                                $resultClass = 'text-red-600';
                                            }
                                        @endphp
                                        <div class="text-xs {{ $resultClass }} font-medium">{{ $result }}</div>
                                    @elseif($game->game_date < now())
                                        <span class="text-orange-600 text-sm">Sin resultado</span>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col space-y-1">
                                        @if($game->home_team_id === $game->team1_id)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-home mr-1"></i>Local
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                <i class="fas fa-plane mr-1"></i>Visitante
                                            </span>
                                        @endif
                                        
                                        @if($game->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Activo
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Inactivo
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.games.show', $game) }}" 
                                           class="text-indigo-600 hover:text-indigo-900" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.games.edit', $game) }}" 
                                           class="text-blue-600 hover:text-blue-900" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        {{-- Botón para actualizar resultado rápido --}}
                                        @if($game->game_date < now() && ($game->score_local === null || $game->score_visitor === null))
                                            <button type="button" 
                                                    class="text-green-600 hover:text-green-900" 
                                                    title="Agregar resultado"
                                                    onclick="openScoreModal({{ $game->id }})">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                        @endif
                                        
                                        <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900" 
                                                    title="Eliminar"
                                                    onclick="return confirm('¿Estás seguro de eliminar este partido?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    <div class="py-8">
                                        <i class="fas fa-futbol text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-lg font-medium">No hay partidos registrados</p>
                                        <p class="text-sm">Comienza agregando tu primer partido</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Paginación --}}
            @if($games->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $games->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Modal para resultado rápido --}}
<div id="scoreModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="scoreForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Actualizar Resultado</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Goles Local</label>
                            <input type="number" name="score_local" min="0" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Goles Visitante</label>
                            <input type="number" name="score_visitor" min="0" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar
                    </button>
                    <button type="button" 
                            onclick="closeScoreModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openScoreModal(gameId) {
        document.getElementById('scoreForm').action = `/admin/games/${gameId}/update-score`;
        document.getElementById('scoreModal').classList.remove('hidden');
    }

    function closeScoreModal() {
        document.getElementById('scoreModal').classList.add('hidden');
        document.getElementById('scoreForm').reset();
    }

    // Cerrar modal al hacer click fuera
    document.getElementById('scoreModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeScoreModal();
        }
    });
</script>
@endpush
</x-admin-layout>