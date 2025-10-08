<x-app-layout>

    <x-slot name="header">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative py-4">
                {{-- Back to Main Page Link --}}
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out mb-2">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Main Page
                </a>
                
                <h1 class="text-4xl font-extrabold text-gray-900 flex items-center gap-3">
                    <i class="fas fa-futbol text-orange-600"></i>
                    Schedule and Results
                </h1>
                <p class="mt-1 text-lg text-gray-600">
                    All our team's encounters: upcoming matches and final scores.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50"> {{-- Add a subtle background to the body --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            {{-- Main Content Title --}}
            <div class="text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">All Team Encounters</h2>
                <div class="w-24 h-1 bg-orange-600 mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($games as $game)
                    @php
                        // Determine status and card styling based on completion and score
                        $isFinished = $game->score_local !== null && $game->score_visitor !== null; 
                        
                        $mainColor = $isFinished ? 'green' : 'orange';
                        $bgColor = $isFinished ? 'from-green-50' : 'from-orange-50';
                        $shadowColor = $isFinished ? 'shadow-green-200/50' : 'shadow-orange-200/50';
                        $tagColor = $isFinished ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800';
                        $statusText = $isFinished ? 'FINAL SCORE' : 'UPCOMING MATCH';
                        $iconClass = $isFinished ? 'fas fa-trophy' : 'fas fa-clock';
                    @endphp
                    
                    <div class="bg-gradient-to-br {{ $bgColor }} to-white rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:{{ $shadowColor }} transition-all duration-300 border border-gray-200">
                        
                        {{-- Competition and Date --}}
                        <div class="flex justify-between items-center mb-4 border-b pb-3 border-gray-100">
                            <span class="{{ $tagColor }} px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                <i class="{{ $iconClass }} text-sm"></i>{{ $statusText }}
                            </span>
                            <span class="text-gray-500 text-sm font-medium">{{ $game->game_date->format('M d, Y') }}</span>
                        </div>

                        {{-- Teams & VS --}}
                        <div class="flex items-center justify-between mb-4">
                            
                            {{-- Home Team --}}
                            <div class="text-center flex-1">
                                <div class="w-16 h-16 bg-white rounded-full mx-auto mb-2 flex items-center justify-center overflow-hidden border-2 border-{{ $mainColor }}-300">
                                    @if($game->homeTeam->logo)
                                        <img src="{{ asset('storage/' . $game->homeTeam->logo) }}" 
                                            alt="{{ $game->homeTeam->name }}" 
                                            class="w-full h-full object-contain p-1">
                                    @else
                                        <i class="fas fa-home text-{{ $mainColor }}-600 text-2xl"></i>
                                    @endif
                                </div>
                                <p class="font-bold text-gray-900 text-sm">{{ $game->homeTeam->name }}</p>
                                <p class="text-xs text-gray-500">Home</p>
                            </div>
                            
                            {{-- Separator / Score --}}
                            <div class="px-4 text-center">
                                @if($isFinished)
                                    <p class="text-3xl font-extrabold text-gray-900 leading-none">{{ $game->score_local }} - {{ $game->score_visitor }}</p>
                                @else
                                    <div class="text-2xl font-bold text-gray-400">VS</div>
                                @endif
                            </div>
                            
                            {{-- Away Team --}}
                            <div class="text-center flex-1">
                                <div class="w-16 h-16 bg-white rounded-full mx-auto mb-2 flex items-center justify-center overflow-hidden border-2 border-gray-300">
                                    @if($game->awayTeam->logo)
                                        <img src="{{ asset('storage/' . $game->awayTeam->logo) }}" 
                                            alt="{{ $game->awayTeam->name }}" 
                                            class="w-full h-full object-contain p-1">
                                    @else
                                        <i class="fas fa-plane text-gray-600 text-2xl"></i>
                                    @endif
                                </div>
                                <p class="font-bold text-gray-900 text-sm">{{ $game->awayTeam->name }}</p>
                                <p class="text-xs text-gray-500">Away</p>
                            </div>
                        </div>

                        {{-- Details --}}
                        <div class="mt-4 pt-4 border-t border-gray-200 text-sm text-gray-600 space-y-1">
                            <p class="text-center font-semibold text-gray-800">{{ $game->competition }}</p>
                            <div class="flex justify-center items-center">
                                <i class="fas fa-clock mr-2 text-{{ $mainColor }}-500"></i>
                                <span>{{ $game->game_date->format('g:i A') }}</span>
                            </div>
                            <div class="flex justify-center items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-{{ $mainColor }}-500"></i>
                                <span>{{ $game->location }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20 border border-dashed border-gray-300 rounded-xl bg-white shadow-inner">
                        <i class="fas fa-calendar-times text-6xl text-gray-400 mb-4"></i>
                        <p class="text-2xl font-bold text-gray-800 mb-2">The season is on pause!</p>
                        <p class="text-gray-600">New games have not been scheduled yet. Check back soon for the dates.</p>
                    </div>
                @endforelse

            </div>
            
            {{-- Pagination --}}
            @if(method_exists($games, 'links'))
                <div class="mt-6">
                    {{ $games->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>