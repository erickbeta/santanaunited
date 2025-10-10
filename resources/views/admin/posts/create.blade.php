<x-admin-layout title="Crear Nueva Noticia">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Título y encabezado --}}
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 flex items-center gap-3">
            <i class="fas fa-newspaper text-indigo-600"></i>
            Crear Nueva Noticia
        </h1>
        
        {{-- Contenedor del formulario --}}
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            
            {{-- Formulario de Creación --}}
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                
                {{-- Inclusión del formulario reutilizable --}}
                @include('admin.posts.form')
                
                {{-- Botones de acción --}}
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('admin.posts.index') }}" 
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors inline-flex items-center">
                        <i class="fas fa-times-circle mr-2"></i>Cancelar
                    </a>
                    
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors inline-flex items-center">
                        <i class="fas fa-save mr-2"></i>Guardar Noticia
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>