<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to Santana United!!</h1>
                <p class="text-xl md:text-2xl mb-8">Next Matches</p>
                <div class="flex justify-center items-center space-x-4">
                    <div class="bg-white text-blue-800 px-6 py-3 rounded-lg font-bold">
                        <span class="text-2xl">15</span>
                        <div class="text-sm">Victorias</div>
                    </div>
                    <div class="bg-white text-blue-800 px-6 py-3 rounded-lg font-bold">
                        <span class="text-2xl">3</span>
                        <div class="text-sm">Empates</div>
                    </div>
                    <div class="bg-white text-blue-800 px-6 py-3 rounded-lg font-bold">
                        <span class="text-2xl">2</span>
                        <div class="text-sm">Derrotas</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <a href="#" class="bg-green-500 hover:bg-green-600 text-white p-6 rounded-lg transition-colors shadow-lg">
                <div class="flex items-center">
                        <i class="fa-solid fa-futbol mr-3 text-3xl" ></i>
                    <div>
                        <h3 class="font-bold text-lg">Partidos</h3>
                        <p class="text-sm opacity-90">Ver calendario</p>
                    </div>
                </div>
            </a>
            
            <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white p-6 rounded-lg transition-colors shadow-lg">
                <div class="flex items-center">
                   <i class="fa-solid fa-exclamation mr-5 text-3xl"></i>
                    <div>
                        <h3 class="font-bold text-lg">Noticias</h3>
                        <p class="text-sm opacity-90">Últimas novedades</p>
                    </div>
                </div>
            </a>
            
            <a href="#" class="bg-red-500 hover:bg-red-600 text-white p-6 rounded-lg transition-colors shadow-lg">
                <div class="flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h3 class="font-bold text-lg">Plantilla</h3>
                        <p class="text-sm opacity-90">Ver jugadores</p>
                    </div>
                </div>
            </a>
            
            <a href="#" class="bg-purple-500 hover:bg-purple-600 text-white p-6 rounded-lg transition-colors shadow-lg">
                <div class="flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-bold text-lg">Estadísticas</h3>
                        <p class="text-sm opacity-90">Ver números</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Próximos Partidos -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        Próximos Partidos
                    </h2>
                    
                    <div class="space-y-4">
                        <!-- Partido 1 -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <div class="text-center">
                                        <div class="text-sm text-gray-500">DOM</div>
                                        <div class="text-xl font-bold">22</div>
                                        <div class="text-sm text-gray-500">SEP</div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-lg">Nuestro Club vs Rivales FC</div>
                                        <div class="text-gray-600">Estadio Municipal - 16:00</div>
                                        <div class="text-sm text-blue-600 font-medium">Liga Regional</div>
                                    </div>
                                </div>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Local</span>
                            </div>
                        </div>
                        
                        <!-- Partido 2 -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <div class="text-center">
                                        <div class="text-sm text-gray-500">SAB</div>
                                        <div class="text-xl font-bold">28</div>
                                        <div class="text-sm text-gray-500">SEP</div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-lg">Deportivo Unidos vs Nuestro Club</div>
                                        <div class="text-gray-600">Estadio Central - 18:30</div>
                                        <div class="text-sm text-blue-600 font-medium">Liga Regional</div>
                                    </div>
                                </div>
                                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">Visitante</span>
                            </div>
                        </div>
                        
                        <!-- Partido 3 -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <div class="text-center">
                                        <div class="text-sm text-gray-500">DOM</div>
                                        <div class="text-xl font-bold">05</div>
                                        <div class="text-sm text-gray-500">OCT</div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-lg">Nuestro Club vs Atlético Sur</div>
                                        <div class="text-gray-600">Estadio Municipal - 15:00</div>
                                        <div class="text-sm text-red-600 font-medium">Copa Regional</div>
                                    </div>
                                </div>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Local</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 text-center">
                        <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors">
                            Ver Todos los Partidos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                
                <!-- Últimas Noticias -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        Últimas Noticias
                    </h3>
                    
                    <div class="space-y-4">
                        <article class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                            <h4 class="font-bold text-gray-800 hover:text-blue-600 cursor-pointer mb-2">
                                Nueva contratación: Llega el delantero estrella
                            </h4>
                            <p class="text-gray-600 text-sm mb-2">
                                El club ha cerrado la incorporación de un nuevo atacante que promete revolucionar el juego ofensivo...
                            </p>
                            <span class="text-xs text-gray-500">Hace 2 horas</span>
                        </article>
                        
                        <article class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                            <h4 class="font-bold text-gray-800 hover:text-blue-600 cursor-pointer mb-2">
                                Entrenamiento especial antes del próximo partido
                            </h4>
                            <p class="text-gray-600 text-sm mb-2">
                                El equipo técnico ha preparado una sesión intensiva para preparar el encuentro del domingo...
                            </p>
                            <span class="text-xs text-gray-500">Ayer</span>
                        </article>
                        
                        <article>
                            <h4 class="font-bold text-gray-800 hover:text-blue-600 cursor-pointer mb-2">
                                Renovación de las instalaciones deportivas
                            </h4>
                            <p class="text-gray-600 text-sm mb-2">
                                Se anuncian mejoras importantes en el estadio y las áreas de entrenamiento...
                            </p>
                            <span class="text-xs text-gray-500">2 días</span>
                        </article>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="#" class="text-blue-500 hover:text-blue-600 text-sm font-medium">
                            Ver todas las noticias →
                        </a>
                    </div>
                </div>

                <!-- Tabla de Posiciones -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tabla de Posiciones
                    </h3>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between items-center py-2 px-3 bg-green-50 rounded-lg border border-green-200">
                            <div class="flex items-center">
                                <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3">2</span>
                                <span class="font-bold text-green-800">Nuestro Club</span>
                            </div>
                            <div class="text-sm font-medium text-green-800">45 pts</div>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="w-6 h-6 bg-gray-400 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3">1</span>
                                <span class="font-medium">Deportivo Líder</span>
                            </div>
                            <div class="text-sm font-medium">47 pts</div>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="w-6 h-6 bg-gray-400 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3">3</span>
                                <span class="font-medium">Atlético Norte</span>
                            </div>
                            <div class="text-sm font-medium">42 pts</div>
                        </div>
                        
                        <div class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="w-6 h-6 bg-gray-400 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3">4</span>
                                <span class="font-medium">Rivales FC</span>
                            </div>
                            <div class="text-sm font-medium">40 pts</div>
                        </div>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="#" class="text-blue-500 hover:text-blue-600 text-sm font-medium">
                            Ver tabla completa →
                        </a>
                    </div>
                </div>

                <!-- Jugador Destacado -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"></path>
                        </svg>
                        Jugador del Mes
                    </h3>
                    
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gray-300 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-lg text-gray-800">Carlos Rodríguez</h4>
                        <p class="text-gray-600 mb-2">Delantero</p>
                        <div class="bg-blue-50 rounded-lg p-3">
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div>
                                    <div class="font-bold text-2xl text-blue-600">8</div>
                                    <div class="text-xs text-gray-600">Goles</div>
                                </div>
                                <div>
                                    <div class="font-bold text-2xl text-blue-600">4</div>
                                    <div class="text-xs text-gray-600">Asistencias</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Últimos Resultados -->
        <div class="mt-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-history w-6 h-6 mr-2 text-blue-500"></i>
                    Últimos Resultados
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Resultado 1 -->
                    <div class="border border-gray-200 rounded-lg p-4 text-center">
                        <div class="text-sm text-gray-500 mb-2">12 Septiembre • Liga Regional</div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-medium">Nuestro Club</span>
                            <span class="text-2xl font-bold text-green-600">3</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-medium">Deportivo Este</span>
                            <span class="text-2xl font-bold text-gray-400">1</span>
                        </div>
                        <span class="inline-block mt-2 bg-green-100 text-green-800 px-2 py-1 rounded text-sm font-medium">Victoria</span>
                    </div>
                    
                    <!-- Resultado 2 -->
                    <div class="border border-gray-200 rounded-lg p-4 text-center">
                        <div class="text-sm text-gray-500 mb-2">05 Septiembre • Liga Regional</div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-medium">Club Central</span>
                            <span class="text-2xl font-bold text-gray-400">1</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-medium">Nuestro Club</span>
                            <span class="text-2xl font-bold text-green-600">2</span>
                        </div>
                        <span class="inline-block mt-2 bg-green-100 text-green-800 px-2 py-1 rounded text-sm font-medium">Victoria</span>
                    </div>
                    
                    <!-- Resultado 3 -->
                    <div class="border border-gray-200 rounded-lg p-4 text-center">
                        <div class="text-sm text-gray-500 mb-2">28 Agosto • Copa Regional</div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-medium">Nuestro Club</span>
                            <span class="text-2xl font-bold text-yellow-600">2</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-medium">Atlético Oeste</span>
                            <span class="text-2xl font-bold text-yellow-600">2</span>
                        </div>
                        <span class="inline-block mt-2 bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm font-medium">Empate</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>