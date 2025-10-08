<x-admin-layout :title="'Edit ' . ucfirst(str_replace('_', ' ', $section))">

    <div class="space-y-8">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-teal-600 via-cyan-600 to-blue-700 rounded-2xl p-8 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                            <i class="fas fa-edit text-2xl text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold">Edit {{ ucfirst(str_replace('_', ' ', $section)) }}</h1>
                            <p class="text-teal-100 mt-1">Customize content for this section</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.home-content.index') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition-colors backdrop-blur-sm">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.home-content.update', $section) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Common Fields -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-file-alt mr-2 text-blue-600"></i>Basic Information
                    </h3>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Title <span class="text-gray-400 font-normal">(Optional)</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title', $content->title) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('title') border-red-500 @enderror"
                               placeholder="Enter section title">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label for="subtitle" class="block text-sm font-semibold text-gray-700 mb-2">
                            Subtitle <span class="text-gray-400 font-normal">(Optional)</span>
                        </label>
                        <input type="text" 
                               name="subtitle" 
                               id="subtitle" 
                               value="{{ old('subtitle', $content->subtitle) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('subtitle') border-red-500 @enderror"
                               placeholder="Enter subtitle">
                        @error('subtitle')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content/Description -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                            Content <span class="text-gray-400 font-normal">(Optional)</span>
                        </label>
                        <textarea name="content" 
                                  id="content" 
                                  rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('content') border-red-500 @enderror"
                                  placeholder="Enter section content">{{ old('content', $content->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Player of the Week Specific Fields -->
            @if($section === 'player_of_week')
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900">
                            <i class="fas fa-star mr-2 text-purple-600"></i>Player Selection & Stats
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Select Player -->
                        <div>
                            <label for="player_id" class="block text-sm font-semibold text-gray-700 mb-2">Select Player</label>
                            <select name="player_id" id="player_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                <option value="">-- Select Player --</option>
                                @foreach($players as $player)
                                    <option value="{{ $player->id }}" {{ old('player_id', $content->data['player_id'] ?? '') == $player->id ? 'selected' : '' }}>
                                        {{ $player->name }} - #{{ $player->jersey_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Weekly Stats -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Goals This Week</label>
                                <input type="number" name="stats_goals" min="0" value="{{ old('stats_goals', $content->data['stats']['goals'] ?? 0) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Assists This Week</label>
                                <input type="number" name="stats_assists" min="0" value="{{ old('stats_assists', $content->data['stats']['assists'] ?? 0) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Match Rating</label>
                                <input type="number" name="stats_rating" min="0" max="10" step="0.1" value="{{ old('stats_rating', $content->data['stats']['rating'] ?? 0) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Goal of the Week Specific Fields -->
            @if($section === 'goal_of_week')
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900">
                            <i class="fas fa-futbol mr-2 text-orange-600"></i>Goal Details
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Seleccionar Jugador -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Select Player</label>
                            <select id="player_select" name="player_id_goal" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                                <option value="" data-team-id="">-- Select Player --</option>
                                @foreach($players as $player)
                                    <option value="{{ $player->id }}" 
                                            data-team-id="{{ $player->team_id }}"
                                            {{ old('player_id_goal', $content->data['player_id'] ?? '') == $player->id ? 'selected' : '' }}>
                                        {{ $player->name }} - #{{ $player->jersey_number }} ({{ $player->team->name ?? 'No Team' }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Or enter name manually below</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Player Name (Manual)</label>
                                <input type="text" name="player_name" value="{{ old('player_name', $content->data['player_name'] ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="Leave empty if selected above">
                            </div>
                            
                            <!-- Seleccionar Equipo Rival -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Opponent Team</label>
                                <select id="opponent_select" name="opponent_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                                    <option value="">-- Select Opponent --</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" 
                                                data-team-id="{{ $team->id }}"
                                                {{ old('opponent_id', $content->data['opponent_id'] ?? '') == $team->id ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Match Date</label>
                            <input type="date" name="match_date" value="{{ old('match_date', $content->data['date'] ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Video URL</label>
                            <input type="url" name="video_url" value="{{ old('video_url', $content->data['video_url'] ?? '') }}" placeholder="https://youtube.com/embed/VIDEO_ID" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                            <p class="mt-1 text-sm text-gray-500">Use YouTube embed URL format</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="Describe the goal...">{{ old('description', $content->data['description'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                @push('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const playerSelect = document.getElementById('player_select');
                        const opponentSelect = document.getElementById('opponent_select');
                        
                        function filterOpponents() {
                            const selectedOption = playerSelect.options[playerSelect.selectedIndex];
                            const playerTeamId = selectedOption.getAttribute('data-team-id');
                            
                            // Mostrar todas las opciones primero
                            Array.from(opponentSelect.options).forEach(option => {
                                option.style.display = '';
                            });
                            
                            // Ocultar el equipo del jugador seleccionado
                            if (playerTeamId) {
                                Array.from(opponentSelect.options).forEach(option => {
                                    const teamId = option.getAttribute('data-team-id');
                                    if (teamId === playerTeamId) {
                                        option.style.display = 'none';
                                        // Si estaba seleccionado, deseleccionarlo
                                        if (option.selected) {
                                            opponentSelect.value = '';
                                        }
                                    }
                                });
                            }
                        }
                        
                        // Filtrar cuando cambia la selección del jugador
                        playerSelect.addEventListener('change', filterOpponents);
                        
                        // Filtrar al cargar la página
                        filterOpponents();
                    });
                </script>
                @endpush
            @endif

            <!-- Image Upload -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-image mr-2 text-green-600"></i>Section Image
                    </h3>
                </div>

                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Current Image Preview -->
                        @if($content->image)
                            <div class="flex-shrink-0">
                                <p class="text-sm font-semibold text-gray-700 mb-2">Current Image</p>
                                <img src="{{ asset('storage/' . $content->image) }}" alt="Current" class="w-48 h-48 object-cover rounded-lg border-4 border-gray-200">
                            </div>
                        @endif

                        <!-- Upload New Image -->
                        <div class="flex-1">
                            <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Upload New Image</label>
                            <input type="file" name="image" id="image" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>Max size: 2MB. Formats: JPG, PNG, JPEG
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Status -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-toggle-on text-green-600"></i>
                            </div>
                            <div>
                                <label for="is_active" class="text-sm font-semibold text-gray-900">Show on Homepage</label>
                                <p class="text-sm text-gray-500">Enable this to display the section on the main page</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $content->is_active) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.home-content.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-semibold transition-colors">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>