<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Panel de Administrador' }} - {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

</head>
<body class="font-sans antialiased bg-gray-50">
    
    <div x-data="{ 
        sidebarOpen: false, 
        sidebarCollapsed: false,
        userMenuOpen: false,
        init() {
            // Recuperar estado del sidebar del localStorage
            this.sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        },
        toggleSidebar() {
            this.sidebarCollapsed = !this.sidebarCollapsed;
            localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
        }
    }" class="flex h-screen bg-gray-50">

        <!-- Sidebar para Desktop -->
        <aside 
            :class="sidebarCollapsed ? 'w-16' : 'w-64'" 
            class="hidden md:flex flex-col bg-gradient-to-b from-gray-900 to-gray-800 shadow-xl transition-all duration-300 ease-in-out relative"
        >
            <!-- Header del Sidebar -->
            <div class="flex items-center justify-center h-16 bg-gray-900/50 backdrop-blur border-b border-gray-700/50">
                <div x-show="!sidebarCollapsed" x-transition class="flex items-center">
                    <img class="h-10 w-10 mr-3 rounded-lg shadow-lg" src="{{ asset('logo.png') }}" alt="Logo Santa Ana United">
                    <div class="flex flex-col">
                        <span class="text-white font-bold text-sm">Santa Ana</span>
                        <span class="text-gray-300 font-medium text-xs">United</span>
                    </div>
                </div>
                <div x-show="sidebarCollapsed" x-transition class="flex items-center">
                    <img class="h-8 w-8 rounded-lg shadow-lg" src="{{ asset('logo.png') }}" alt="Logo">
                </div>
            </div>

            <!-- Botón de colapsar sidebar -->
            <button 
                @click="toggleSidebar()" 
                class="absolute -right-3 top-20 bg-white border-2 border-gray-200 rounded-full p-1.5 shadow-lg hover:shadow-xl transition-all duration-200 z-10 group"
            >
                <i :class="sidebarCollapsed ? 'fa-chevron-right' : 'fa-chevron-left'" class="fas text-gray-600 text-xs group-hover:text-blue-600 transition-colors"></i>
            </button>

            <!-- Navegación -->
            <div class="flex flex-col flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-transparent">
                <nav class="flex-1 px-3 py-6 space-y-2">
                    
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       @class([
                           'group flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-gradient-to-r hover:from-blue-600 hover:to-blue-500 transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg',
                           'bg-gradient-to-r from-blue-600 to-blue-500 shadow-lg' => request()->routeIs('admin.dashboard')
                       ])>
                        <i class="fa-solid fa-tachometer-alt text-lg w-5"></i>
                        <span x-show="!sidebarCollapsed" x-transition class="ml-3 font-medium">Dashboard</span>
                        <div x-show="sidebarCollapsed" class="absolute left-16 bg-gray-900 text-white px-2 py-1 rounded-md text-sm opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                            Dashboard
                        </div>
                    </a>

                    <!-- Carrusel -->
                    <a href="{{ route('admin.carousel.index') }}" 
                       @class([
                           'group flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-gradient-to-r hover:from-purple-600 hover:to-purple-500 transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg',
                           'bg-gradient-to-r from-purple-600 to-purple-500 shadow-lg' => request()->routeIs('admin.carousel.*')
                       ])>
                        <i class="fa-solid fa-images text-lg w-5"></i>
                        <span x-show="!sidebarCollapsed" x-transition class="ml-3 font-medium">Carrusel</span>
                        <div x-show="sidebarCollapsed" class="absolute left-16 bg-gray-900 text-white px-2 py-1 rounded-md text-sm opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                            Carrusel
                        </div>
                    </a>

                    <!-- Equipos -->
                    <a href="{{ route('admin.teams.index') }}" 
                       @class([
                           'group flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-gradient-to-r hover:from-green-600 hover:to-green-500 transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg',
                           'bg-gradient-to-r from-green-600 to-green-500 shadow-lg' => request()->routeIs('admin.teams.*')
                       ])>
                        <i class="fa-solid fa-shield-halved text-lg w-5"></i>
                        <span x-show="!sidebarCollapsed" x-transition class="ml-3 font-medium">Equipos</span>
                        <div x-show="sidebarCollapsed" class="absolute left-16 bg-gray-900 text-white px-2 py-1 rounded-md text-sm opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                            Equipos
                        </div>
                    </a>

                    <!-- Partidos -->
                    <a href="{{ route('admin.games.index') }}" 
                       @class([
                           'group flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-gradient-to-r hover:from-orange-600 hover:to-orange-500 transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg',
                           'bg-gradient-to-r from-orange-600 to-orange-500 shadow-lg' => request()->routeIs('admin.games.*')
                       ])>
                        <i class="fa-solid fa-futbol text-lg w-5"></i>
                        <span x-show="!sidebarCollapsed" x-transition class="ml-3 font-medium">Partidos</span>
                        <div x-show="sidebarCollapsed" class="absolute left-16 bg-gray-900 text-white px-2 py-1 rounded-md text-sm opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                            Partidos
                        </div>
                    </a>

                    <!-- Jugadores -->
                    <a href="{{ route('admin.players.index') }}" 
                       @class([
                           'group flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-gradient-to-r hover:from-indigo-600 hover:to-indigo-500 transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg',
                           'bg-gradient-to-r from-indigo-600 to-indigo-500 shadow-lg' => request()->routeIs('admin.players.*')
                       ])>
                        <i class="fa-solid fa-users text-lg w-5"></i>
                        <span x-show="!sidebarCollapsed" x-transition class="ml-3 font-medium">Jugadores</span>
                        <div x-show="sidebarCollapsed" class="absolute left-16 bg-gray-900 text-white px-2 py-1 rounded-md text-sm opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                            Jugadores
                        </div>
                    </a>

                    <!-- Noticias -->
                    <a href="{{ route('admin.posts.index') }}" 
                       @class([
                           'group flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-gradient-to-r hover:from-red-600 hover:to-red-500 transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg',
                           'bg-gradient-to-r from-red-600 to-red-500 shadow-lg' => request()->routeIs('admin.posts.*')
                       ])>
                        <i class="fa-solid fa-newspaper text-lg w-5"></i>
                        <span x-show="!sidebarCollapsed" x-transition class="ml-3 font-medium">Noticias</span>
                        <div x-show="sidebarCollapsed" class="absolute left-16 bg-gray-900 text-white px-2 py-1 rounded-md text-sm opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                            Noticias
                        </div>
                    </a>

                    <!-- Home Content -->
                    <a href="{{ route('admin.home-content.index') }}" 
                    @class([
                        'group flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-gradient-to-r hover:from-teal-600 hover:to-teal-500 transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg',
                        'bg-gradient-to-r from-teal-600 to-teal-500 shadow-lg' => request()->routeIs('admin.home-content.*')
                    ])>
                        <i class="fa-solid fa-home text-lg w-5"></i>
                        <span x-show="!sidebarCollapsed" x-transition class="ml-3 font-medium">Home Content</span>
                        <div x-show="sidebarCollapsed" class="absolute left-16 bg-gray-900 text-white px-2 py-1 rounded-md text-sm opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                            Home Content
                        </div>
                    </a>

                </nav>

                <!-- Información del usuario en el sidebar -->
                <div x-show="!sidebarCollapsed" x-transition class="p-3 border-t border-gray-700/50 bg-gray-900/30">
                    <div class="flex items-center space-x-3 p-3 rounded-xl bg-gray-800/50 hover:bg-gray-800 transition-colors">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-white font-medium text-sm truncate">{{ Auth::user()->name }}</p>
                            <p class="text-gray-400 text-xs">Administrador</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <div class="flex flex-col flex-1 min-w-0">
            <!-- Header -->
            <header class="flex justify-between items-center px-6 py-4 bg-white border-b border-gray-200 shadow-sm">
                <!-- Botón menú móvil -->
                <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700 focus:outline-none md:hidden transition-colors">
                    <i class="fa-solid fa-bars fa-xl"></i>
                </button>

                <!-- Título -->
                <div class="flex-1 flex items-center space-x-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $title ?? 'Panel de Administrador' }}</h1>
                        <p class="text-sm text-gray-600 mt-1">Gestiona tu sistema desde aquí</p>
                    </div>
                </div>
                
                <!-- Usuario y acciones -->
                <div class="flex items-center space-x-4">
                    <!-- Notificaciones -->
                    <button class="relative p-2 text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                        <i class="fa-solid fa-bell text-lg"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- Menú de usuario -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 focus:outline-none transition-colors">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <div class="hidden sm:block text-left">
                                <p class="text-gray-700 font-medium text-sm">{{ Auth::user()->name }}</p>
                                <p class="text-gray-500 text-xs">Administrador</p>
                            </div>
                            <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                        </button>

                        <!-- Dropdown del usuario -->
                        <div x-show="open" @click.outside="open = false" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                <i class="fa-solid fa-user mr-2"></i>
                                Mi Perfil
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                <i class="fa-solid fa-cog mr-2"></i>
                                Configuración
                            </a>
                            <hr class="my-1 border-gray-200">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <i class="fa-solid fa-sign-out-alt mr-2"></i>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Contenido -->
            <main class="flex-1 p-6 overflow-y-auto bg-gray-50">
                {{ $slot }}
            </main>
        </div>

        <!-- Sidebar móvil -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 flex md:hidden" style="display: none;">
            
            <div @click="sidebarOpen = false" class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
            
            <aside x-transition:enter="transition ease-in-out duration-300 transform"
                   x-transition:enter-start="-translate-x-full"
                   x-transition:enter-end="translate-x-0"
                   x-transition:leave="transition ease-in-out duration-300 transform"
                   x-transition:leave-start="translate-x-0"
                   x-transition:leave-end="-translate-x-full"
                   class="relative flex flex-col w-64 bg-gradient-to-b from-gray-900 to-gray-800 shadow-xl">
                
                <!-- Header móvil -->
                <div class="flex items-center justify-between h-16 bg-gray-900/50 px-4 border-b border-gray-700/50">
                    <div class="flex items-center">
                        <img class="h-8 w-8 mr-2 rounded-lg" src="{{ asset('logo.png') }}" alt="Logo">
                        <span class="text-white font-bold text-sm">Santa Ana United</span>
                    </div>
                    <button @click="sidebarOpen = false" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>

                <!-- Navegación móvil -->
                <div class="flex flex-col flex-1 overflow-y-auto">
                    <nav class="flex-1 px-3 py-4 space-y-2">
                        <a href="{{ route('admin.dashboard') }}" @class(['flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-blue-600 transition-all duration-200', 'bg-blue-600' => request()->routeIs('admin.dashboard')])>
                            <i class="fa-solid fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.carousel.index') }}" @class(['flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-purple-600 transition-all duration-200', 'bg-purple-600' => request()->routeIs('admin.carousel.*')])>
                            <i class="fa-solid fa-images mr-3"></i> Carrusel
                        </a>
                        <a href="{{ route('admin.teams.index') }}" @class(['flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-green-600 transition-all duration-200', 'bg-green-600' => request()->routeIs('admin.teams.*')])>
                            <i class="fa-solid fa-shield-halved mr-3"></i> Equipos
                        </a>
                        <a href="{{ route('admin.games.index') }}" @class(['flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-orange-600 transition-all duration-200', 'bg-orange-600' => request()->routeIs('admin.games.*')])>
                            <i class="fa-solid fa-futbol mr-3"></i> Partidos
                        </a>
                        <a href="{{ route('admin.players.index') }}" @class(['flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-indigo-600 transition-all duration-200', 'bg-indigo-600' => request()->routeIs('admin.players.*')])>
                            <i class="fa-solid fa-users mr-3"></i> Jugadores
                        </a>
                        <a href="{{ route('admin.posts.index') }}" @class(['flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-red-600 transition-all duration-200', 'bg-red-600' => request()->routeIs('admin.posts.*')])>
                            <i class="fa-solid fa-newspaper mr-3"></i> Noticias
                        </a>
                        
                        <a href="{{ route('admin.home-content.index') }}" 
                        @class([
                            'flex items-center px-3 py-3 rounded-xl text-gray-100 hover:bg-teal-600 transition-all duration-200', 
                            'bg-teal-600' => request()->routeIs('admin.home-content.*')
                        ])>
                            <i class="fa-solid fa-home mr-3"></i> Home Content
                        </a>
                    </nav>

                    <!-- Usuario en móvil -->
                    <div class="p-4 border-t border-gray-700/50">
                        <div class="flex items-center space-x-3 p-3 rounded-xl bg-gray-800/50">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="text-white font-medium text-sm">{{ Auth::user()->name }}</p>
                                <p class="text-gray-400 text-xs">Administrador</p>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    @stack('scripts')
</body>
</html>