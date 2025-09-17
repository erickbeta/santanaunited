<x-app-layout>
{{-- En resources/views/welcome.blade.php --}}

<div class="relative text-white"> <div class="swiper">
        <div class="swiper-wrapper">
            @foreach ($carouselImages as $image)
                <div class="swiper-slide relative">
                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                         alt="{{ $image->title ?? 'Carousel Image' }}" 
                         class="w-full h-auto">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 to-transparent"></div>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev text-white"></div>
        <div class="swiper-button-next text-white"></div>
    </div>

    <div class="absolute inset-0 flex flex-col items-center justify-end z-10 pb-16 md:pb-24">
        {{-- ... El contenido del texto y los botones se queda igual ... --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to Santana United</h1>
                <p class="text-xl md:text-2xl mb-8">Your club, Your Family.</p>
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('games.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-full text-lg transition duration-300 ease-in-out transform hover:scale-105">
                        Ver Próximos Partidos
                    </a>
                    <a href="{{ route('posts.index') }}" class="bg-white/90 hover:bg-white text-blue-900 font-semibold px-8 py-3 rounded-full text-lg transition duration-300 ease-in-out transform hover:scale-105">
                        Últimas Noticias
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('games.index') }}" class="bg-green-500 hover:bg-green-600 text-white p-6 rounded-lg transition-colors shadow-lg">
                <div class="flex items-center">
                    <i class="fa-solid fa-futbol mr-3 text-3xl"></i>
                    <div>
                        <h3 class="font-bold text-lg">Partidos</h3>
                        <p class="text-sm opacity-90">Ver calendario</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('posts.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-6 rounded-lg transition-colors shadow-lg">
                <div class="flex items-center">
                   <i class="fa-solid fa-exclamation mr-5 text-3xl"></i>
                   <div>
                       <h3 class="font-bold text-lg">Noticias</h3>
                       <p class="text-sm opacity-90">Últimas novedades</p>
                   </div>
                </div>
            </a>
            {{-- Asumiendo que tienes rutas nombradas para estas secciones --}}
            <a href="{{ route('players.index') }}" class="bg-red-500 hover:bg-red-600 text-white p-6 rounded-lg transition-colors shadow-lg">
                 <div class="flex items-center">
                    {{-- ... icono ... --}}
                    <div>
                        <h3 class="font-bold text-lg">Plantilla</h3>
                        <p class="text-sm opacity-90">Ver jugadores</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('stats.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white p-6 rounded-lg transition-colors shadow-lg">
                <div class="flex items-center">
                    {{-- ... icono ... --}}
                    <div>
                        <h3 class="font-bold text-lg">Estadísticas</h3>
                        <p class="text-sm opacity-90">Ver números</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        {{-- ... icono ... --}}
                        Próximos Partidos
                    </h2>
                    
                    <div class="space-y-4">
                        {{-- Bucle para mostrar los próximos partidos dinámicamente --}}
                        @forelse ($upcomingGames as $game)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-4">
                                        <div class="text-center">
                                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($game->game_date)->format('D') }}</div>
                                            <div class="text-xl font-bold">{{ \Carbon\Carbon::parse($game->game_date)->format('d') }}</div>
                                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($game->game_date)->format('M') }}</div>
                                        </div>
                                        <div>
                                            <div class="font-bold text-lg">
                                                @if($game->type === 'local')
                                                    Nuestro Club vs {{ $game->opponent }}
                                                @else
                                                    {{ $game->opponent }} vs Nuestro Club
                                                @endif
                                            </div>
                                            <div class="text-gray-600">{{ $game->location }} - {{ \Carbon\Carbon::parse($game->game_date)->format('H:i') }}</div>
                                            <div class="text-sm text-blue-600 font-medium">{{ $game->competition }}</div>
                                        </div>
                                    </div>
                                    @if($game->type === 'local')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Local</span>
                                    @else
                                        <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">Visitante</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center">No hay próximos partidos programados.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        {{-- ... icono ... --}}
                        Últimas Noticias
                    </h3>
                    <div class="space-y-4">
                        {{-- Bucle para mostrar las últimas noticias --}}
                        @forelse ($latestPosts as $post)
                            <article class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                                <h4 class="font-bold text-gray-800 hover:text-blue-600 cursor-pointer mb-2">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                </h4>
                                <p class="text-gray-600 text-sm mb-2">
                                    {{ Str::limit($post->body, 120) }} {{-- Asumiendo una columna 'body' --}}
                                </p>
                                <span class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                            </article>
                        @empty
                             <p class="text-gray-500">No hay noticias recientes.</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        {{-- ... icono ... --}}
                        Tabla de Posiciones
                    </h3>
                    <div class="space-y-2">
                        {{-- Bucle para la tabla de posiciones --}}
                        @foreach ($teams as $team)
                            <div @class([
                                'flex justify-between items-center py-2 px-3 rounded-lg',
                                'bg-green-50 border border-green-200' => $team->name === 'Santana United', // Tu nombre de equipo
                                'bg-gray-50' => $team->name !== 'Santana United',
                            ])>
                                <div class="flex items-center">
                                    <span @class([
                                        'w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold mr-3 text-white',
                                        'bg-green-500' => $team->name === 'Santana United',
                                        'bg-gray-400' => $team->name !== 'Santana United',
                                    ])>{{ $loop->iteration }}</span>
                                    <span @class([
                                        'font-bold text-green-800' => $team->name === 'Santana United',
                                        'font-medium' => $team->name !== 'Santana United',
                                    ])>{{ $team->name }}</span>
                                </div>
                                <div @class([
                                    'text-sm font-medium',
                                    'text-green-800' => $team->name === 'Santana United',
                                ])>{{ $team->points }} pts</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        {{-- ... icono ... --}}
                        Jugador del Mes
                    </h3>
                    {{-- Comprobamos si existe un jugador destacado --}}
                    @if ($featuredPlayer)
                        <div class="text-center">
                            <img src="{{ $featuredPlayer->photo_url }}" alt="{{ $featuredPlayer->name }}" class="w-20 h-20 object-cover rounded-full mx-auto mb-4">
                            <h4 class="font-bold text-lg text-gray-800">{{ $featuredPlayer->name }}</h4>
                            <p class="text-gray-600 mb-2">{{ $featuredPlayer->position }}</p>
                            <div class="bg-blue-50 rounded-lg p-3">
                                <div class="grid grid-cols-2 gap-4 text-center">
                                    <div>
                                        <div class="font-bold text-2xl text-blue-600">{{ $featuredPlayer->goals }}</div>
                                        <div class="text-xs text-gray-600">Goles</div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-2xl text-blue-600">{{ $featuredPlayer->assists }}</div>
                                        <div class="text-xs text-gray-600">Asistencias</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-center text-gray-500">Aún no hay jugador del mes.</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="mt-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-history w-6 h-6 mr-2 text-blue-500"></i>
                    Últimos Resultados
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse ($latestResults as $result)
                        <div class="border border-gray-200 rounded-lg p-4 text-center">
                            <div class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($result->game_date)->format('d F') }} • {{ $result->competition }}</div>
                            <div class="flex justify-between items-center mb-2">
                                {{-- Aquí obtenemos los nombres de los equipos desde la relación --}}
                                <span class="font-medium">{{ $result->homeTeam->name }}</span> 
                                <span class="text-2xl font-bold">{{ $result->score_local }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-medium">{{ $result->awayTeam->name }}</span>
                                {{-- CAMBIO IMPORTANTE AQUÍ --}}
                                <span class="text-2xl font-bold">{{ $result->away_team_score }}</span>
                            </div>

                            @php
                                // LÓGICA AJUSTADA CON TUS COLUMNAS
                                $myTeamId = 1; // El mismo ID que en el controlador
                                $outcome = 'Empate';
                                $outcomeClass = 'bg-yellow-100 text-yellow-800';

                                if ($result->score_local !== $result->away_team_score) {
                                    if (($result->home_team_id == $myTeamId && $result->score_local > $result->away_team_score) || 
                                        ($result->away_team_id == $myTeamId && $result->away_team_score > $result->score_local)) {
                                        $outcome = 'Victoria';
                                        $outcomeClass = 'bg-green-100 text-green-800';
                                    } else {
                                        $outcome = 'Derrota';
                                        $outcomeClass = 'bg-red-100 text-red-800';
                                    }
                                }
                            @endphp
                            <span class="inline-block mt-2 px-2 py-1 rounded text-sm font-medium {{ $outcomeClass }}">{{ $outcome }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 md:col-span-3 text-center">No hay resultados recientes.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
<script>
    const swiper = new Swiper('.swiper', {
        loop: true, 
        autoplay: {
            delay: 5000, 
            disableOnInteraction: false,
        },

        autoHeight: true, 

        
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        // Flechas de navegación
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
@endpush

</x-app-layout>