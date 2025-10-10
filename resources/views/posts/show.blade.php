<x-app-layout>
        <x-slot name="header">

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumb / Enlace de regreso --}}
            <div class="mb-6">
                <a href="{{ route('posts.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver a Todas las Noticias
                </a>
            </div>

            <article class="bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-100">

                {{-- Imagen Destacada --}}
                @if($post->featured_image)
                    <img class="w-full h-80 object-cover" 
                         src="{{ asset('storage/' . $post->featured_image) }}" 
                         alt="{{ $post->title }}">
                @else
                    <div class="w-full h-80 bg-gray-200 flex items-center justify-center text-gray-500">
                        <i class="fas fa-image text-6xl"></i>
                    </div>
                @endif
                
                <div class="p-8 md:p-10 lg:p-12">
                    
                    {{-- Metadatos --}}
                    <div class="text-sm text-gray-500 mb-4 flex items-center space-x-4">
                        <span class="font-medium text-indigo-600 uppercase tracking-wider">Noticia del Club</span>
                        <span class="text-gray-400">•</span>
                        <span><i class="fas fa-calendar-alt mr-1"></i> Publicado: {{ $post->published_at->format('d M, Y') }}</span>
                    </div>

                    {{-- Título --}}
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                        {{ $post->title }}
                    </h1>

                    {{-- Resumen (Si existe) --}}
                    @if($post->summary)
                        <p class="text-xl italic text-gray-600 mb-8 border-l-4 border-indigo-400 pl-4">
                            {{ $post->summary }}
                        </p>
                    @endif

                    {{-- Cuerpo del Contenido --}}
                    <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed space-y-6">
                        {{-- 
                            ATENCIÓN: Si el contenido del 'body' se gestiona con un editor WYSIWYG
                            que produce HTML (como TinyMCE o CKEditor), DEBES usar {!! $post->body !!} 
                            para renderizar el HTML correctamente. 
                        --}}
                        {!! $post->body !!}
                    </div>

                </div>
            </article>

            {{-- Espacio para volver al listado --}}
            <div class="mt-8 text-center">
                <a href="{{ route('posts.index') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-3 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg shadow-indigo-500/50">
                    <i class="fas fa-list-alt mr-2"></i> Ver Todo el Archivo de Noticias
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>