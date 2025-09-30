<x-admin-layout :title="'Dashboard'">

    <div class="space-y-8">
        
        <!-- Header de Bienvenida -->
        <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 rounded-2xl p-8 text-white overflow-hidden shadow-2xl">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
            
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">¡Bienvenido de vuelta, {{ Auth::user()->name }}!</h1>
                        <p class="text-blue-100 text-lg">Panel de Administración - Santa Ana United</p>
                        <p class="text-blue-200 mt-1">Gestiona todo el contenido del club desde aquí</p>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-blue-100 text-sm">Último acceso</p>
                            <p class="text-white font-semibold">{{ now()->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-futbol text-2xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas Principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Equipos -->
            <div class="group bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-green-200 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Equipos</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalTeams ?? '8' }}</p>
                        <p class="text-sm text-green-600 mt-1">
                            <i class="fas fa-arrow-up mr-1"></i>
                            +2 este mes
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-shield-halved text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Jugadores -->
            <div class="group bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Jugadores</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPlayers ?? '156' }}</p>
                        <p class="text-sm text-blue-600 mt-1">
                            <i class="fas fa-arrow-up mr-1"></i>
                            +12 este mes
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Partidos -->
            <div class="group bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-orange-200 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Partidos</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalGames ?? '24' }}</p>
                        <p class="text-sm text-orange-600 mt-1">
                            <i class="fas fa-calendar mr-1"></i>
                            3 próximos
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-futbol text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Noticias -->
            <div class="group bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-purple-200 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Noticias</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPosts ?? '42' }}</p>
                        <p class="text-sm text-purple-600 mt-1">
                            <i class="fas fa-edit mr-1"></i>
                            5 borradores
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-newspaper text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones Rápidas y Actividad Reciente -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Acciones Rápidas -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Acciones Rápidas</h3>
                        <i class="fas fa-bolt text-yellow-500 text-xl"></i>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Carrusel -->
                        <div class="group relative bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200 hover:shadow-lg transition-all duration-300 hover:scale-[1.02]">
                            <div class="absolute top-4 right-4">
                                <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-images text-white text-sm"></i>
                                </div>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Gestionar Carrusel</h4>
                            <p class="text-gray-600 text-sm mb-4">Administra las imágenes destacadas de la página principal</p>
                            <a href="{{ route('admin.carousel.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold text-sm transition-colors">
                                Administrar
                                <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>

                        <!-- Equipos -->
                        <div class="group relative bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200 hover:shadow-lg transition-all duration-300 hover:scale-[1.02]">
                            <div class="absolute top-4 right-4">
                                <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-shield-halved text-white text-sm"></i>
                                </div>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Gestionar Equipos</h4>
                            <p class="text-gray-600 text-sm mb-4">Crea, edita y organiza todos los equipos del club</p>
                            <a href="{{ route('admin.teams.index') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold text-sm transition-colors">
                                Administrar
                                <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>

                        <!-- Partidos -->
                        <div class="group relative bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 border border-orange-200 hover:shadow-lg transition-all duration-300 hover:scale-[1.02]">
                            <div class="absolute top-4 right-4">
                                <div class="w-8 h-8 bg-orange-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-futbol text-white text-sm"></i>
                                </div>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Gestionar Partidos</h4>
                            <p class="text-gray-600 text-sm mb-4">Programa nuevos encuentros y registra resultados</p>
                            <a href="{{ route('admin.games.index') }}" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-semibold text-sm transition-colors">
                                Administrar
                                <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>

                        <!-- Jugadores -->
                        <div class="group relative bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300 hover:scale-[1.02]">
                            <div class="absolute top-4 right-4">
                                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-white text-sm"></i>
                                </div>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Gestionar Jugadores</h4>
                            <p class="text-gray-600 text-sm mb-4">Administra toda la plantilla y datos de jugadores</p>
                            <a href="{{ route('admin.players.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors">
                                Administrar
                                <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel Lateral -->
            <div class="space-y-6">
                
                <!-- Noticias -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Noticias</h3>
                        <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-sm"></i>
                        </div>
                    </div>
                    
                    <div class="group relative bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 border border-red-200 hover:shadow-lg transition-all duration-300 hover:scale-[1.02]">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Gestionar Noticias</h4>
                        <p class="text-gray-600 text-sm mb-4">Publica y administra las últimas novedades del club</p>
                        <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-red-600 hover:text-red-700 font-semibold text-sm transition-colors">
                            Administrar
                            <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Próximos Partidos -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Próximos Partidos</h3>
                        <i class="fas fa-calendar-alt text-blue-500"></i>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-futbol text-blue-600 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">vs Atlético</p>
                                    <p class="text-xs text-gray-500">Dom 15:00</p>
                                </div>
                            </div>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Local</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-futbol text-orange-600 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">vs Deportivo</p>
                                    <p class="text-xs text-gray-500">Sáb 18:00</p>
                                </div>
                            </div>
                            <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">Visita</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-futbol text-purple-600 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">vs Racing</p>
                                    <p class="text-xs text-gray-500">Dom 16:30</p>
                                </div>
                            </div>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Local</span>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('admin.games.index') }}" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-lg transition-all duration-200 flex items-center justify-center">
                            Ver Todos los Partidos
                            <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Actividad Reciente -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Actividad Reciente</h3>
                        <i class="fas fa-clock text-gray-400"></i>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <p class="text-sm text-gray-800">Nuevo jugador agregado</p>
                                <p class="text-xs text-gray-500">Hace 2 horas</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <p class="text-sm text-gray-800">Partido programado</p>
                                <p class="text-xs text-gray-500">Hace 5 horas</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <p class="text-sm text-gray-800">Noticia publicada</p>
                                <p class="text-xs text-gray-500">Hace 1 día</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen Semanal (Opcional) -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900">Resumen de la Semana</h3>
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <i class="fas fa-calendar-week"></i>
                    <span>{{ now()->startOfWeek()->format('d M') }} - {{ now()->endOfWeek()->format('d M Y') }}</span>
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-plus text-white text-sm"></i>
                    </div>
                    <p class="text-2xl font-bold text-blue-600">3</p>
                    <p class="text-xs text-gray-600">Jugadores Nuevos</p>
                </div>
                
                <div class="text-center p-4 bg-green-50 rounded-lg border border-green-200">
                    <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-trophy text-white text-sm"></i>
                    </div>
                    <p class="text-2xl font-bold text-green-600">2</p>
                    <p class="text-xs text-gray-600">Partidos Ganados</p>
                </div>
                
                <div class="text-center p-4 bg-purple-50 rounded-lg border border-purple-200">
                    <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-edit text-white text-sm"></i>
                    </div>
                    <p class="text-2xl font-bold text-purple-600">5</p>
                    <p class="text-xs text-gray-600">Noticias Publicadas</p>
                </div>
                
                <div class="text-center p-4 bg-orange-50 rounded-lg border border-orange-200">
                    <div class="w-10 h-10 bg-orange-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-eye text-white text-sm"></i>
                    </div>
                    <p class="text-2xl font-bold text-orange-600">1.2k</p>
                    <p class="text-xs text-gray-600">Visitas Web</p>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>