<x-app-layout>
{{-- Hero Section con Carrusel --}}
<section id="home" class="relative text-white scroll-mt-20">
    <div class="relative w-full h-[500px] md:h-[600px] lg:h-[700px] overflow-hidden carousel-container">
        @foreach ($carouselImages as $index => $image)
            <div class="carousel-slide absolute inset-0 transition-all duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" 
                 data-slide="{{ $index }}">
                <img src="{{ asset('storage/' . $image->image_path) }}" 
                     alt="{{ $image->title ?? 'Carousel Image' }}" 
                     class="w-full h-full object-cover">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                
                @if($image->title || $image->description)
                    <div class="absolute bottom-24 left-0 right-0 px-6 z-10">
                        <div class="max-w-7xl mx-auto">
                            @if($image->title)
                                <h3 class="text-3xl md:text-5xl font-bold mb-3 animate-fade-in">{{ $image->title }}</h3>
                            @endif
                            @if($image->description)
                                <p class="text-lg md:text-xl opacity-90 max-w-2xl">{{ $image->description }}</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        @endforeach

        @if(count($carouselImages) > 1)
            <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white p-4 rounded-full transition-all duration-300 z-20 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white p-4 rounded-full transition-all duration-300 z-20 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
                @foreach($carouselImages as $index => $image)
                    <button class="carousel-dot w-3 h-3 rounded-full transition-all duration-300 focus:outline-none {{ $index === 0 ? 'bg-white w-8' : 'bg-white/50' }}" 
                            data-slide="{{ $index }}"></button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Hero Content --}}
    <div class="absolute inset-0 flex flex-col items-center justify-center z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 tracking-tight" style="text-shadow: 0 10px 30px rgba(0,0,0,0.8);">
                Welcome to Santana United
            </h1>
            <p class="text-2xl md:text-3xl mb-10 font-light" style="text-shadow: 0 4px 12px rgba(0,0,0,0.6);">
                Your Club, Your Family
            </p>
           
        </div>
    </div>
</section>

{{-- Quick Access Cards --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('games.index') }}" class="group bg-white hover:bg-[#1F346E] p-8 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-2">
                <div class="flex items-center">
                    <div class="bg-green-100 group-hover:bg-white/20 p-4 rounded-xl transition-colors duration-300">
                        <i class="fa-solid fa-futbol text-green-600 group-hover:text-white text-4xl transition-colors duration-300"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="font-bold text-xl text-gray-900 group-hover:text-white transition-colors duration-300">Games</h3>
                        <p class="text-sm text-gray-600 group-hover:text-gray-200 transition-colors duration-300">View schedule</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('posts.index') }}" class="group bg-white hover:bg-[#1F346E] p-8 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-2">
                <div class="flex items-center">
                    <div class="bg-yellow-100 group-hover:bg-white/20 p-4 rounded-xl transition-colors duration-300">
                        <i class="fa-solid fa-newspaper text-yellow-600 group-hover:text-white text-4xl transition-colors duration-300"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="font-bold text-xl text-gray-900 group-hover:text-white transition-colors duration-300">News</h3>
                        <p class="text-sm text-gray-600 group-hover:text-gray-200 transition-colors duration-300">Latest updates</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('players.index') }}" class="group bg-white hover:bg-[#1F346E] p-8 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-2">
                <div class="flex items-center">
                    <div class="bg-red-100 group-hover:bg-white/20 p-4 rounded-xl transition-colors duration-300">
                        <i class="fa-solid fa-users text-red-600 group-hover:text-white text-4xl transition-colors duration-300"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="font-bold text-xl text-gray-900 group-hover:text-white transition-colors duration-300">Squad</h3>
                        <p class="text-sm text-gray-600 group-hover:text-gray-200 transition-colors duration-300">View players</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('stats.index') }}" class="group bg-white hover:bg-[#1F346E] p-8 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-2">
                <div class="flex items-center">
                    <div class="bg-purple-100 group-hover:bg-white/20 p-4 rounded-xl transition-colors duration-300">
                        <i class="fa-solid fa-chart-bar text-purple-600 group-hover:text-white text-4xl transition-colors duration-300"></i>
                    </div>
                    <div class="ml-5">
                        <h3 class="font-bold text-xl text-gray-900 group-hover:text-white transition-colors duration-300">Statistics</h3>
                        <p class="text-sm text-gray-600 group-hover:text-gray-200 transition-colors duration-300">View stats</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- Upcoming Games --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Upcoming Games</h2>
            <div class="w-24 h-1 bg-[#1F346E] mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($upcomingGames as $game)
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $game->competition }}</span>
                        <span class="text-gray-500 text-sm">{{ $game->game_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <!-- Home Team -->
                        <div class="text-center flex-1">
                            <div class="w-16 h-16 bg-[#1F346E] rounded-full mx-auto mb-2 flex items-center justify-center overflow-hidden">
                                @if($game->homeTeam->logo)
                                    <img src="{{ asset('storage/' . $game->homeTeam->logo) }}" 
                                         alt="{{ $game->homeTeam->name }}" 
                                         class="w-full h-full object-contain p-2">
                                @else
                                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                                @endif
                            </div>
                            <p class="font-bold text-gray-900 text-sm">{{ $game->homeTeam->name }}</p>
                        </div>
                        
                        <div class="text-2xl font-bold text-gray-400 px-4">VS</div>
                        
                        <!-- Away Team -->
                        <div class="text-center flex-1">
                            <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-2 flex items-center justify-center overflow-hidden">
                                @if($game->awayTeam->logo)
                                    <img src="{{ asset('storage/' . $game->awayTeam->logo) }}" 
                                         alt="{{ $game->awayTeam->name }}" 
                                         class="w-full h-full object-contain p-2">
                                @else
                                    <i class="fas fa-shield-alt text-gray-600 text-2xl"></i>
                                @endif
                            </div>
                            <p class="font-bold text-gray-900 text-sm">{{ $game->awayTeam->name }}</p>
                        </div>
                    </div>
                    <div class="text-center text-sm text-gray-600">
                        <i class="fas fa-clock mr-1"></i>{{ $game->game_date->format('g:i A') }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-map-marker-alt mr-1"></i>{{ $game->location }}
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">No upcoming games scheduled</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('games.index') }}" class="inline-flex items-center bg-[#1F346E] hover:bg-[#2a4a8f] text-white font-bold px-8 py-3 rounded-full transition-all duration-300 transform hover:scale-105">
                View All Games <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

{{-- Featured Players --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Featured Players</h2>
            <div class="w-24 h-1 bg-[#1F346E] mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach($featuredPlayers as $player)
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-indigo-600 relative">
                        <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm rounded-full px-3 py-1">
                            <span class="text-white font-bold">#{{ $player->jersey_number ?? '?' }}</span>
                        </div>
                    </div>
                    <div class="absolute top-32 left-1/2 transform -translate-x-1/2">
                        <div class="w-24 h-24 rounded-full border-4 border-white bg-gray-200 overflow-hidden">
                            @if($player->photo_url)
                                <img src="{{ asset('storage/' . $player->photo_url) }}" alt="{{ $player->name }}" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-user text-4xl text-gray-400 flex items-center justify-center h-full"></i>
                            @endif
                        </div>
                    </div>
                    <div class="pt-16 pb-6 px-6 text-center">
                        <h3 class="font-bold text-xl text-gray-900 mb-2">{{ $player->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $player->position ?? 'Player' }}</p>
                        <div class="flex justify-center space-x-4 text-sm">
                            <div class="text-center">
                                <div class="font-bold text-lg">{{ $player->goals }}</div>
                                <div class="text-gray-500">Goals</div>
                            </div>
                            <div class="text-center">
                                <div class="font-bold text-lg">{{ $player->assists }}</div>
                                <div class="text-gray-500">Assists</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Player of the Week --}}
@if($playerOfWeek && $weekPlayer)
<section class="py-20 bg-gradient-to-br from-[#1F346E] to-[#2a4a8f] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2">
                <div class="inline-block bg-yellow-400 text-gray-900 px-4 py-2 rounded-full font-bold mb-6">
                    <i class="fas fa-star mr-2"></i>PLAYER OF THE WEEK
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6">{{ $playerOfWeek->title ?? 'Outstanding Performance' }}</h2>
                <p class="text-xl text-blue-100 mb-8">
                    {{ $playerOfWeek->subtitle ?? 'Incredible performance leading the team to victory.' }}
                </p>
                <div class="grid grid-cols-3 gap-6 mb-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold">{{ $weekPlayer->week_stats['goals'] ?? $weekPlayer->goals }}</div>
                        <div class="text-blue-200 text-sm">Goals</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold">{{ $weekPlayer->week_stats['assists'] ?? $weekPlayer->assists }}</div>
                        <div class="text-blue-200 text-sm">Assists</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold">{{ $weekPlayer->week_stats['rating'] ?? '10' }}</div>
                        <div class="text-blue-200 text-sm">Rating</div>
                    </div>
                </div>
            </div>
            <div class="lg:w-1/2">
                <div class="relative">
                    <div class="w-80 h-80 bg-white/10 rounded-full mx-auto backdrop-blur-sm border-4 border-white/20 overflow-hidden">
                        @if($weekPlayer->photo_url)
                            <img src="{{ asset('storage/' . $weekPlayer->photo_url) }}" alt="{{ $weekPlayer->name }}" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-user text-9xl text-white/50 flex items-center justify-center h-full"></i>
                        @endif
                    </div>
                    <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 bg-white text-[#1F346E] px-8 py-4 rounded-2xl shadow-2xl">
                        <h3 class="text-2xl font-bold">{{ $weekPlayer->name }}</h3>
                        <p class="text-gray-600">#{{ $weekPlayer->jersey_number }} - {{ $weekPlayer->position }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Latest News --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Latest News</h2>
            <div class="w-24 h-1 bg-[#1F346E] mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($latestPosts as $post)
                <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-indigo-500"></div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>{{ $post->created_at->format('F d, Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ Str::limit($post->title, 60) }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                        <a href="{{ route('posts.show', $post) }}" class="text-[#1F346E] font-semibold hover:text-[#2a4a8f] transition-colors">
                            Read More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12">
                    <i class="fas fa-newspaper text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">No news available</p>
                </div>
            @endforelse
        </div></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-48 bg-gradient-to-br from-blue-400 to-indigo-500"></div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>December 10, 2024</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Team Prepares for Championship Final</h3>
                    <p class="text-gray-600 mb-4">Training intensifies as Santana United gets ready for the biggest match of the season...</p>
                    <a href="#" class="text-[#1F346E] font-semibold hover:text-[#2a4a8f] transition-colors">
                        Read More <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </article>

            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-48 bg-gradient-to-br from-green-400 to-emerald-500"></div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>December 8, 2024</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">New Signing Joins the Squad</h3>
                    <p class="text-gray-600 mb-4">Santana United announces the arrival of promising young talent to strengthen the team...</p>
                    <a href="#" class="text-[#1F346E] font-semibold hover:text-[#2a4a8f] transition-colors">
                        Read More <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </article>

            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-48 bg-gradient-to-br from-red-400 to-pink-500"></div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>December 5, 2024</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Youth Academy Celebrates Success</h3>
                    <p class="text-gray-600 mb-4">Our youth program continues to develop future stars with impressive tournament results...</p>
                    <a href="#" class="text-[#1F346E] font-semibold hover:text-[#2a4a8f] transition-colors">
                        Read More <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </article>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center bg-[#1F346E] hover:bg-[#2a4a8f] text-white font-bold px-8 py-3 rounded-full transition-all duration-300 transform hover:scale-105">
                View All News <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

{{-- Goal of the Week --}}
@if($goalOfWeek && $goalOfWeek->is_active)
@php
    // Asegurar que data sea un array
    $goalData = is_array($goalOfWeek->data) 
        ? $goalOfWeek->data 
        : json_decode($goalOfWeek->data, true) ?? [];
@endphp

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-6 py-3 rounded-full font-bold mb-6">
                <i class="fas fa-trophy mr-2"></i>GOAL OF THE WEEK
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                {{ $goalOfWeek->title ?? 'Spectacular Strike!' }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ $goalOfWeek->subtitle ?? 'An incredible moment of pure talent and precision.' }}
            </p>
        </div>

        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl overflow-hidden shadow-2xl">
            @if(!empty($goalData['video_url']))
                <div class="aspect-video">
                    <iframe src="{{ $goalData['video_url'] }}" 
                            class="w-full h-full" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
            @else
                <div class="aspect-video bg-gray-700 flex items-center justify-center">
                    <div class="text-center text-white">
                        <i class="fas fa-play-circle text-6xl mb-4 opacity-75"></i>
                        <p class="text-xl font-semibold">Video Highlight Coming Soon</p>
                    </div>
                </div>
            @endif
            
            <div class="p-8 bg-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">
                            {{ $goalData['player_name'] ?? 'Player Name' }} 
                            @if(!empty($goalData['description']))
                                - {{ $goalData['description'] }}
                            @endif
                        </h3>
                        <p class="text-gray-600">
                            vs {{ $goalData['opponent'] ?? 'Opponent' }} • 
                            {{ !empty($goalData['date']) ? \Carbon\Carbon::parse($goalData['date'])->format('F d, Y') : 'Recent' }}
                        </p>
                    </div>
                    @if(!empty($goalData['video_url']))
                        <a href="{{ $goalData['video_url'] }}" 
                           target="_blank" 
                           class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-full font-semibold transition-colors inline-flex items-center justify-center">
                            <i class="fab fa-youtube mr-2"></i>Watch on YouTube
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Photo Gallery --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Photo Gallery</h2>
            <div class="w-24 h-1 bg-[#1F346E] mx-auto mb-4"></div>
            <p class="text-xl text-gray-600">Capturing our best moments on and off the field</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="relative group overflow-hidden rounded-2xl aspect-square bg-gradient-to-br from-blue-400 to-indigo-500 cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl aspect-square bg-gradient-to-br from-green-400 to-emerald-500 cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl aspect-square bg-gradient-to-br from-red-400 to-pink-500 cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl aspect-square bg-gradient-to-br from-purple-400 to-violet-500 cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl aspect-square bg-gradient-to-br from-yellow-400 to-orange-500 cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl aspect-square bg-gradient-to-br from-pink-400 to-red-500 cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl aspect-square bg-gradient-to-br from-cyan-400 to-blue-500 cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl aspect-square bg-gradient-to-br from-teal-400 to-green-500 cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="#" class="inline-flex items-center bg-[#1F346E] hover:bg-[#2a4a8f] text-white font-bold px-8 py-3 rounded-full transition-all duration-300 transform hover:scale-105">
                View Full Gallery <i class="fas fa-images ml-2"></i>
            </a>
        </div>
    </div>
</section>

{{-- About Us Section --}}
<section id="about" class="py-20 bg-gray-50 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                {{ $aboutContent->title ?? 'About Us' }}
            </h2>
            <div class="w-24 h-1 bg-[#1F346E] mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h3 class="text-3xl font-bold text-gray-900">
                    {{ $aboutContent->subtitle ?? 'Our Story' }}
                </h3>
                <div class="text-lg text-gray-700 leading-relaxed">
                    {!! $aboutContent->content ?? 
                        '<p>Santana United was founded with the passion to create a club where soccer and community unite. 
                        We are more than a team, we are a family that shares values of respect, dedication, and sporting excellence.</p>
                        <p class="mt-4">Since our beginning, we have worked to develop local talent and create opportunities for 
                        young soccer players to reach their maximum potential, both on and off the field.</p>' 
                    !!}
                </div>
                <div class="flex gap-8 pt-4">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#1F346E]">{{ $stats['total_players'] ?? '50+' }}</div>
                        <div class="text-sm text-gray-600 mt-1">Players</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#1F346E]">15+</div>
                        <div class="text-sm text-gray-600 mt-1">Years</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#1F346E]">{{ $stats['wins'] ?? '100+' }}</div>
                        <div class="text-sm text-gray-600 mt-1">Victories</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="bg-[#1F346E] text-white p-8 rounded-2xl transform hover:scale-105 transition-transform duration-300">
                    <i class="fa-solid fa-trophy text-5xl mb-4"></i>
                    <h4 class="text-xl font-bold mb-2">Our Mission</h4>
                    <p class="text-sm opacity-90">Develop talent and promote sporting values in our community.</p>
                </div>
                <div class="bg-gray-900 text-white p-8 rounded-2xl transform hover:scale-105 transition-transform duration-300 mt-8">
                    <i class="fa-solid fa-heart text-5xl mb-4"></i>
                    <h4 class="text-xl font-bold mb-2">Core Values</h4>
                    <ul class="grid grid-cols-2 gap-x-4 gap-y-1">
                        <li class="text-sm opacity-90">· Courage</li>
                        <li class="text-sm opacity-90">· Humbleness</li>
                        <li class="text-sm opacity-90">· Passion</li>
                        <li class="text-sm opacity-90">· Respect</li>
                        <li class="text-sm opacity-90">· Friendship</li>
                        <li class="text-sm opacity-90">· Fun</li>
                        <li class="text-sm opacity-90 col-span-2 text-center">· Family</li>
                    </ul>
                </div>
                <div class="bg-gray-900 text-white p-8 rounded-2xl transform hover:scale-105 transition-transform duration-300 -mt-8">
                    <i class="fa-solid fa-users text-5xl mb-4"></i>
                    <h4 class="text-xl font-bold mb-2">Our Community</h4>
                    <p class="text-sm opacity-90">Families united as one big sports family.</p>
                </div>
                <div class="bg-[#1F346E] text-white p-8 rounded-2xl transform hover:scale-105 transition-transform duration-300">
                    <i class="fa-solid fa-star text-5xl mb-4"></i>
                    <h4 class="text-xl font-bold mb-2">Our Vision</h4>
                    <p class="text-sm opacity-90">To be the reference club in sports training and human values.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Call to Action --}}
<section class="bg-[#1F346E] text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Join Us?</h2>
        <p class="text-xl mb-8 opacity-90">Become part of the Santana United family</p>
        <a href="#" class="bg-white text-[#1F346E] font-bold px-10 py-4 rounded-full text-lg inline-block transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
            Contact Us
        </a>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll para navegación con offset del navbar
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            
            const targetId = this.getAttribute('href');
            
            // Ignorar enlaces vacíos o solo con #
            if (targetId === '#' || !targetId) return;
            
            const target = document.querySelector(targetId);
            
            if (target) {
                // Altura del navbar (ajusta si es necesario)
                const navbarHeight = 80;
                
                // Calcular posición con offset
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - navbarHeight;
                
                // Scroll suave
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Carrusel
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    if (slides.length === 0) return;
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    let autoplayInterval;

    function showSlide(index) {
        slides.forEach(slide => {
            slide.classList.remove('opacity-100', 'z-10');
            slide.classList.add('opacity-0', 'z-0');
        });
        
        slides[index].classList.remove('opacity-0', 'z-0');
        slides[index].classList.add('opacity-100', 'z-10');
        
        dots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.remove('bg-white/50', 'w-3');
                dot.classList.add('bg-white', 'w-8');
            } else {
                dot.classList.remove('bg-white', 'w-8');
                dot.classList.add('bg-white/50', 'w-3');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    function startAutoplay() {
        if (totalSlides > 1) {
            autoplayInterval = setInterval(nextSlide, 5000);
        }
    }

    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            stopAutoplay();
            startAutoplay();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            stopAutoplay();
            startAutoplay();
        });
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
            stopAutoplay();
            startAutoplay();
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            prevSlide();
            stopAutoplay();
            startAutoplay();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
            stopAutoplay();
            startAutoplay();
        }
    });

    startAutoplay();
});
</script>

<style>
html {
    scroll-behavior: smooth;
}

/* Compensar el navbar en las secciones */
section[id] {
    scroll-margin-top: 5rem;
}

.scroll-mt-20 {
    scroll-margin-top: 5rem;
}

@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

/* Prevenir conflictos de scroll */
* {
    scroll-behavior: inherit;
}
</style>
@endpush

</x-app-layout>