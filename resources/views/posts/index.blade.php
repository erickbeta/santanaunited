<x-app-layout>

    <x-slot name="header">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative py-4">
                {{-- Breadcrumb / Enlace a la página principal --}}
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 transition duration-150 ease-in-out mb-2">
                    <i class="fas fa-home mr-2"></i>
                    Inicio
                </a>
                
                <h1 class="text-4xl font-extrabold text-gray-900 flex items-center gap-3">
                    <i class="fas fa-newspaper text-indigo-600"></i>
                    Últimas Noticias del Club
                </h1>
                <p class="mt-1 text-lg text-gray-600">
                    Mantente al día con los anuncios, eventos y resultados de nuestro equipo.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @forelse($posts as $post)
                    <div class="bg-white rounded-xl shadow-xl overflow-hidden transform hover:scale-[1.01] transition-transform duration-300 border border-gray-100">
                        
                        {{-- Imagen Destacada --}}
                        <a href="{{ route('posts.show', $post->slug) }}" class="block">
                            @if($post->featured_image)
                                <img class="h-56 w-full object-cover transition duration-300 hover:opacity-90" 
                                     src="{{ asset('storage/' . $post->featured_image) }}" 
                                     alt="{{ $post->title }}">
                            @else
                                <div class="h-56 w-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    <i class="fas fa-camera text-4xl"></i>
                                </div>
                            @endif
                        </a>

                        <div class="p-6">
                            
                            {{-- Fecha de Publicación --}}
                            <div class="text-sm text-gray-500 mb-2 font-medium flex items-center">
                                <i class="fas fa-calendar-alt mr-2 text-indigo-500"></i>
                                {{ $post->published_at->format('d M, Y') }}
                            </div>
                            
                            {{-- Título --}}
                            <h2 class="text-xl font-bold text-gray-900 mb-3 leading-snug">
                                <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-indigo-600 transition-colors line-clamp-2">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            
                            {{-- Resumen / Extracto --}}
                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                {{ $post->summary ?? Str::words(strip_tags($post->body), 20, '...') }}
                            </p>
                            
                            {{-- Enlace "Leer más" --}}
                            <a href="{{ route('posts.show', $post->slug) }}" 
                               class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold text-sm transition-colors">
                                Leer más 
                                <i class="fas fa-arrow-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    {{-- Mensaje si no hay posts --}}
                    <div class="lg:col-span-3 text-center py-20 border border-dashed border-gray-300 rounded-xl bg-white shadow-inner">
                        <i class="fas fa-calendar-times text-6xl text-gray-400 mb-4"></i>
                        <p class="text-2xl font-bold text-gray-800 mb-2">¡No hay noticias publicadas!</p>
                        <p class="text-gray-600">Vuelve pronto para ver los últimos anuncios del club.</p>
                    </div>
                @endforelse

            </div>

            {{-- Paginación --}}
            @if(method_exists($posts, 'links'))
                <div class="mt-10">
                    {{ $posts->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>