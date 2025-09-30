<nav x-data="{ open: false }" class="bg-[#1F346E] h-34">
    <!-- Primary Navigation Menu -->
    <div class="flex max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 justify-between items-center h-full">
        
        <!-- Logo and Main Navigation Section -->
        <div class="flex items-center space-x-8">
            <a href="#">
                <x-application-logo class="block h-8 fill-current text-gray-800" style="margin-top:-20px;" />
            </a>
            
        </div>

        <div class="flex items-center space-x-8 ">
        <a href="{{ route('home') }}" class="font-lg text-white hover:text-gray-500 transition-colors">
                Home
        </a>
        <a href="{{ route('home') }}" class="text-xl text-white hover:text-gray-500 transition-colors">
                About Us
        </a>


        <a href="{{ route('home') }}" class="text-xl text-white hover:text-gray-500 transition-colors">
       @auth
    <p>Bienvenido, {{ Auth::user()->name }}</p>

    <p>Tus Roles: 
        {{-- 1. Asegúrate de llamar a getRoleNames() --}}
        @php
            $roles = Auth::user()->getRoleNames();
        @endphp
        
        @if ($roles->isNotEmpty())
            {{-- 2. Implode la colección de nombres de roles para mostrarlos --}}
            <strong>{{ implode(', ', $roles->toArray()) }}</strong>
        @else
            No hay roles asignados.
        @endif
    </p>

    {{-- Lógica alternativa: Muestra el enlace de administrador solo si es admin --}}
    @if(Auth::user()->hasRole('admin'))
        <p><a href="{{ route('admin.dashboard') }}">Ir al Panel de Administración</a></p>
    @endif
@endauth


            @guest
                {{-- Opcional: muestra algo a los invitados --}}
                <p>Inicia sesión para ver tu información.</p>
            @endguest

        </a>
        </div>

     

        <!-- Right side - Login/User dropdown -->
        @guest
        <div class="flex items-center">
            <a href="{{ route('login') }}" class="text-xl text-white hover:text-gray-200 transition-colors">
                Log In
            </a>
        </div>
        @endguest

        <!-- Settings Dropdown for authenticated users -->
        @auth
        <div class="hidden sm:flex sm:items-center">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
        @endauth

        <!-- Hamburger Menu for mobile -->
        <div class="flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-blue-600 focus:outline-none focus:bg-blue-600 focus:text-white transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-600">
        
        <!-- Links for non-authenticated users in mobile -->
        @guest
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-white hover:bg-blue-700 transition-colors">
                Home
            </a>
            <a href="{{ route('login') }}" class="block px-4 py-2 text-white hover:bg-blue-700 transition-colors">
                Log In
            </a>
        </div>
        @endguest

        <!-- Authenticated user options in mobile -->
        @auth
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white bg-blue-700">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-blue-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-blue-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-white">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>