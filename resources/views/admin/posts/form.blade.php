@csrf
<div class="space-y-6">
    
    {{-- Título --}}
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title ?? '') }}" required
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3"
               placeholder="Título principal de la noticia">
        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Resumen --}}
    <div>
        <label for="summary" class="block text-sm font-medium text-gray-700">Resumen (Breve descripción)</label>
        <textarea name="summary" id="summary" rows="3"
                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3"
                  placeholder="Máximo 500 caracteres, usado en el listado de noticias.">{{ old('summary', $post->summary ?? '') }}</textarea>
        @error('summary')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Cuerpo (Contenido Completo) --}}
    <div>
        <label for="body" class="block text-sm font-medium text-gray-700">Contenido Completo (Body)</label>
        {{-- En una aplicación real, aquí integrarías un editor WYSIWYG (TinyMCE, CKEditor) --}}
        <textarea name="body" id="body" rows="15" required
                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3"
                  placeholder="Contenido detallado de la noticia.">{{ old('body', $post->body ?? '') }}</textarea>
        @error('body')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Imagen Destacada --}}
    <div class="border p-4 rounded-lg bg-gray-50">
        <label for="featured_image" class="block text-sm font-bold text-gray-700 mb-2">Imagen Destacada</label>
        
        @if(isset($post) && $post->featured_image)
            <p class="text-xs text-gray-500 mb-2">Imagen actual:</p>
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Imagen actual" class="h-32 w-auto object-cover rounded-lg shadow mb-3 border border-gray-200">
        @endif
        
        <input type="file" name="featured_image" id="featured_image"
               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        
        @if(isset($post) && $post->featured_image)
            <p class="text-xs text-gray-500 mt-1">Sube un nuevo archivo para reemplazar la imagen.</p>
        @endif
        
        @error('featured_image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 rounded-lg border border-indigo-200 bg-indigo-50">
        
        {{-- Fecha de Publicación --}}
        <div>
            <label for="published_at" class="block text-sm font-medium text-gray-700">Fecha y Hora de Publicación (Agendar)</label>
            <input type="datetime-local" name="published_at" id="published_at" 
                   value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3">
            <p class="text-xs text-gray-500 mt-1">Si dejas esta fecha en el futuro, la noticia no se mostrará públicamente hasta ese momento.</p>
            @error('published_at')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Estado de Publicación --}}
        <div class="flex flex-col justify-start pt-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
            <div class="flex items-center pt-2">
                <input type="checkbox" name="is_published" id="is_published" value="1" 
                       @checked(old('is_published', $post->is_published ?? false))
                       class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="is_published" class="ml-3 block text-base font-semibold text-indigo-800">
                    Marcar como Publicado (Visible al público)
                </label>
            </div>
            <p class="text-xs text-gray-500 mt-1">Si está desmarcado, se guarda como borrador.</p>
            @error('is_published')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
</div>
