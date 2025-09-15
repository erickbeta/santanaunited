<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Panel de Administrador' }} - {{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">

        <aside class="hidden md:flex flex-col w-64 bg-gray-800">
                <div class="flex items-center justify-center h-16 bg-gray-900">
                    <img class="h-16 w-16 mr-3" src="{{ asset('logo.png') }}" alt="Logo Santa Ana United">
                
                    <span class="text-white font-bold uppercase">Santa Ana</span>
                </div>
            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav class="flex-1 px-2 py-4 bg-gray-800">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-700">
                        <i class="fa-solid fa-tachometer-alt mr-2"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.carousel.index') }}" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700">
                        <i class="fa-solid fa-images mr-2"></i>
                        Carrusel
                    </a>
                </nav>
            </div>
        </aside>

        <div class="flex flex-col flex-1">
            <header class="flex justify-between items-center p-4 bg-white border-b">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none md:hidden">
                    <i class="fa-solid fa-bars fa-xl"></i>
                </button>
                <div class="flex-1">
                        <h1 class="text-xl font-semibold">{{ $title ?? 'Panel de Administrador' }}</h1>
                </div>
                
                {{-- Aquí puedes poner un menú de usuario, notificaciones, etc. --}}
                <div>
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                </div>
            </header>

                <main class="flex-1 p-6 overflow-y-auto">
                    {{ $slot }}
                </main>
        </div>

        <div x-show="sidebarOpen" class="fixed inset-0 z-20 flex md:hidden" style="display: none;">
            <div @click="sidebarOpen = false" class="fixed inset-0 bg-black opacity-50"></div>
            <aside class="relative flex flex-col w-64 bg-gray-800">
                <div class="flex items-center justify-center h-16 bg-gray-900">
                    <span class="text-white font-bold uppercase">Tu Logo/Marca</span>
                </div>
                <div class="flex flex-col flex-1 overflow-y-auto">
                    <nav class="flex-1 px-2 py-4 bg-gray-800">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-700">
                            <i class="fa-solid fa-tachometer-alt mr-2"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.carousel.index') }}" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700">
                            <i class="fa-solid fa-images mr-2"></i>
                            Carrusel
                        </a>
                    </nav>
                </div>
            </aside>
        </div>
        
    </div>
</body>
</html>