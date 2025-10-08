<x-admin-layout :title="'Gestionar Jugadores'">

    <div class="space-y-8" x-data="playersManager()">
        
        <!-- Header con estadísticas -->
        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-700 rounded-2xl p-8 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
            
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                                <i class="fas fa-users text-2xl text-white"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold">Gestionar Jugadores</h1>
                                <p class="text-blue-100 mt-1">Administra toda la plantilla agrupada por equipos</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Estadísticas rápidas -->
                    <div class="hidden md:grid grid-cols-2 gap-4">
                        <div class="bg-white bg-opacity-20 rounded-xl p-4 text-center backdrop-blur-sm">
                            <p class="text-2xl font-bold">{{ $players->total() }}</p>
                            <p class="text-blue-100 text-sm">Total Jugadores</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-xl p-4 text-center backdrop-blur-sm">
                            <p class="text-2xl font-bold">{{ $players->groupBy('team_id')->count() }}</p>
                            <p class="text-blue-100 text-sm">Equipos</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-xl p-4 text-center backdrop-blur-sm">
                            <p class="text-2xl font-bold">{{ $players->where('is_featured', true)->count() }}</p>
                            <p class="text-blue-100 text-sm">Destacados</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-xl p-4 text-center backdrop-blur-sm">
                            <p class="text-2xl font-bold">{{ $players->sum('goals') }}</p>
                            <p class="text-blue-100 text-sm">Goles Total</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controles superiores -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <!-- Navegación breadcrumb -->
            <div class="flex items-center text-sm text-gray-500">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">
                    <i class="fas fa-home mr-1"></i> Dashboard
                </a>
                <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                <span class="text-gray-900 font-medium">Jugadores por Equipo</span>
            </div>
            
            <!-- Filtros y acciones -->
            <div class="flex flex-wrap items-center gap-3">
                <!-- Búsqueda -->
                <div class="relative">
                    <input type="text" 
                           x-model="searchTerm" 
                           @input="filterPlayers()" 
                           placeholder="Buscar jugadores..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <!-- Filtro por equipo -->
                <select x-model="selectedTeam" @change="filterPlayers()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Todos los equipos</option>
                    @foreach($players->groupBy('team_id') as $teamId => $teamPlayers)
                        <option value="{{ $teamId }}">{{ $teamPlayers->first()->team->name }}</option>
                    @endforeach
                </select>

                <!-- Filtro por posición -->
                <select x-model="selectedPosition" @change="filterPlayers()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Todas las posiciones</option>
                    <option value="Portero">Portero</option>
                    <option value="Defensa">Defensa</option>
                    <option value="Mediocampo">Mediocampo</option>
                    <option value="Delantero">Delantero</option>
                </select>

                <!-- Botón agregar -->
                <a href="{{ route('admin.players.create') }}" 
                   class="group bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                    <div class="w-5 h-5 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-2 group-hover:bg-opacity-30 transition-all">
                        <i class="fas fa-plus text-sm"></i>
                    </div>
                    Añadir Jugador
                </a>
            </div>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition 
                 class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg p-4 shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-green-800 font-semibold">¡Operación exitosa!</p>
                            <p class="text-green-700 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button @click="show = false" class="text-green-400 hover:text-green-600 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Jugadores Agrupados por Equipo -->
        @php
            $playersByTeam = $players->groupBy('team_id');
        @endphp

        @if($playersByTeam->count() > 0)
            @foreach($playersByTeam as $teamId => $teamPlayers)
                @php
                    $team = $teamPlayers->first()->team;
                @endphp
                
                <div class="team-section bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100" data-team-id="{{ $teamId }}">
                    <!-- Header del equipo -->
                    <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white bg-opacity-10 rounded-lg flex items-center justify-center mr-4 backdrop-blur-sm">
                                <i class="fas fa-shield-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white">{{ $team->name }}</h2>
                                <p class="text-gray-300 text-sm">{{ $teamPlayers->count() }} jugador{{ $teamPlayers->count() != 1 ? 'es' : '' }}</p>
                            </div>
                        </div>
                        
                        <!-- Estadísticas del equipo -->
                        <div class="flex items-center space-x-6 text-white">
                            <div class="text-center">
                                <div class="text-2xl font-bold">{{ $teamPlayers->sum('goals') }}</div>
                                <div class="text-xs text-gray-300">Goles</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">{{ $teamPlayers->sum('assists') }}</div>
                                <div class="text-xs text-gray-300">Asistencias</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">{{ $teamPlayers->where('is_active', true)->count() }}</div>
                                <div class="text-xs text-gray-300">Activos</div>
                            </div>
                        </div>
                    </div>

                    <!-- Grid de jugadores del equipo -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($teamPlayers as $player)
                                <div class="player-card group relative bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 hover:border-blue-300 overflow-hidden transform hover:-translate-y-2" 
                                     data-position="{{ $player->position }}"
                                     data-name="{{ strtolower($player->name) }}">
                                    
                                    <!-- Header de la tarjeta -->
                                    <div class="relative h-32 bg-gradient-to-r from-blue-500 to-indigo-600 p-4">
                                        <!-- Badges superiores -->
                                        <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                                            @if($player->is_featured)
                                                <span class="bg-yellow-400 text-yellow-900 px-2 py-1 rounded-full text-xs font-semibold shadow-sm">
                                                    <i class="fas fa-star mr-1"></i>Destacado
                                                </span>
                                            @endif
                                            
                                            @if(!$player->is_active)
                                                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold shadow-sm">
                                                    <i class="fas fa-pause mr-1"></i>Inactivo
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Número de camiseta -->
                                        <div class="absolute top-3 right-3">
                                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                                <span class="text-white font-bold text-lg">#{{ $player->jersey_number ?? '?' }}</span>
                                            </div>
                                        </div>

                                        <!-- Foto del jugador -->
                                        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2">
                                            <div class="w-16 h-16 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-200">
                                                @if($player->photo_url)
                                                    <img src="{{ asset('storage/' . $player->photo_url) }}" alt="{{ $player->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                                                        <i class="fas fa-user text-gray-600 text-xl"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contenido de la tarjeta -->
                                    <div class="pt-10 pb-6 px-4 text-center">
                                        <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $player->name }}</h3>
                                        
                                        <!-- Posición -->
                                        @if($player->position)
                                            <div class="mb-3">
                                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">
                                                    {{ $player->position }}
                                                </span>
                                            </div>
                                        @endif

                                        <!-- Estadísticas -->
                                        <div class="grid grid-cols-2 gap-3 mb-4">
                                            <div class="text-center">
                                                <div class="text-lg font-bold text-gray-900">{{ $player->goals }}</div>
                                                <div class="text-xs text-gray-500 uppercase tracking-wider">Goles</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-lg font-bold text-gray-900">{{ $player->assists }}</div>
                                                <div class="text-xs text-gray-500 uppercase tracking-wider">Asistencias</div>
                                            </div>
                                        </div>

                                        <!-- Edad -->
                                        @if($player->birth_date)
                                            <div class="text-sm text-gray-600 mb-4">
                                                <i class="fas fa-birthday-cake mr-1"></i>
                                                {{ \Carbon\Carbon::parse($player->birth_date)->age }} años
                                            </div>
                                        @endif

                                        <!-- Acciones -->
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.players.show', $player) }}" 
                                               class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-2 rounded-lg text-xs font-semibold transition-colors flex items-center">
                                                <i class="fas fa-eye mr-1"></i> Ver
                                            </a>
                                            <a href="{{ route('admin.players.edit', $player) }}" 
                                               class="bg-blue-100 hover:bg-blue-200 text-blue-600 px-3 py-2 rounded-lg text-xs font-semibold transition-colors flex items-center">
                                                <i class="fas fa-edit mr-1"></i> Editar
                                            </a>
                                            <form action="{{ route('admin.players.destroy', $player) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" 
                                                        onclick="confirmDeletePlayer(this.form, '{{ $player->name }}')"
                                                        class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded-lg text-xs font-semibold transition-colors flex items-center">
                                                    <i class="fas fa-trash mr-1"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Estado vacío -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="text-center py-16 px-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay jugadores registrados</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Comienza añadiendo jugadores a tu plantilla para gestionar toda la información del equipo.
                    </p>
                    <a href="{{ route('admin.players.create') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>
                        Añadir Primer Jugador
                    </a>
                </div>
            </div>
        @endif

        <!-- Paginación -->
        @if($players->hasPages())
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Mostrando {{ $players->firstItem() }} a {{ $players->lastItem() }} de {{ $players->total() }} jugadores
                    </div>
                    <div>
                        {{ $players->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

@push('scripts')
<script>
    function playersManager() {
        return {
            searchTerm: '',
            selectedTeam: '',
            selectedPosition: '',
            
            init() {
                this.filterPlayers();
                this.animateCards();
            },

            filterPlayers() {
                const cards = document.querySelectorAll('.player-card');
                const sections = document.querySelectorAll('.team-section');
                
                cards.forEach(card => {
                    const name = card.dataset.name;
                    const position = card.dataset.position;
                    
                    const matchesSearch = !this.searchTerm || name.includes(this.searchTerm.toLowerCase());
                    const matchesPosition = !this.selectedPosition || position === this.selectedPosition;
                    
                    card.style.display = (matchesSearch && matchesPosition) ? 'block' : 'none';
                });

                // Ocultar/mostrar secciones de equipo
                sections.forEach(section => {
                    const teamId = section.dataset.teamId;
                    const matchesTeam = !this.selectedTeam || teamId === this.selectedTeam;
                    
                    if (!matchesTeam) {
                        section.style.display = 'none';
                        return;
                    }
                    
                    const visibleCards = section.querySelectorAll('.player-card[style*="display: block"], .player-card:not([style*="display: none"])');
                    section.style.display = visibleCards.length > 0 ? 'block' : 'none';
                });
            },

            animateCards() {
                const cards = document.querySelectorAll('.player-card');
                cards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        card.style.transition = 'all 0.6s ease-out';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 50);
                });
            }
        }
    }

    function confirmDeletePlayer(form, playerName) {
        if (confirm(`¿Estás seguro de que quieres eliminar al jugador "${playerName}"?\n\nEsta acción no se puede deshacer.`)) {
            form.submit();
        }
        return false;
    }
</script>
@endpush

</x-admin-layout>