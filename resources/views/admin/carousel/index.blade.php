<x-admin-layout :title="'Gestionar Carrusel'">

    <div class="space-y-8">
        
        <!-- Header con estadísticas -->
        <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-700 rounded-2xl p-8 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
            
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                                <i class="fas fa-images text-2xl text-white"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold">Gestionar Carrusel</h1>
                                <p class="text-purple-100 mt-1">Administra las imágenes destacadas de tu página principal</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Estadística rápida -->
                    <div class="hidden md:flex items-center space-x-6 text-center">
                        <div class="bg-white bg-opacity-20 rounded-xl p-4 backdrop-blur-sm">
                            <p class="text-2xl font-bold">{{ $carouselImages->count() }}</p>
                            <p class="text-purple-100 text-sm">Total Imágenes</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-xl p-4 backdrop-blur-sm">
                            <p class="text-2xl font-bold">{{ $carouselImages->where('active', true)->count() ?? $carouselImages->count() }}</p>
                            <p class="text-purple-100 text-sm">Activas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones principales -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <!-- Navegación breadcrumb -->
            <div class="flex items-center text-sm text-gray-500">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-purple-600 transition-colors">
                    <i class="fas fa-home mr-1"></i> Dashboard
                </a>
                <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                <span class="text-gray-900 font-medium">Carrusel</span>
            </div>
            
            <!-- Botón de añadir -->
            <a href="{{ route('admin.carousel.create') }}" 
               class="group bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                <div class="w-5 h-5 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3 group-hover:bg-opacity-30 transition-all">
                    <i class="fas fa-plus text-sm"></i>
                </div>
                Añadir Nueva Imagen
            </a>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition 
                 class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg p-4 shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-green-800 font-semibold">¡Operación exitosa!</p>
                            <p class="text-green-700 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button @click="show = false" class="text-green-400 hover:text-green-600 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Lista de imágenes -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            
            <!-- Header de la tabla -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Imágenes del Carrusel</h3>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-sort mr-2"></i>
                        Ordenadas por prioridad
                    </div>
                </div>
            </div>

            @if ($carouselImages->count() > 0)
                <!-- Vista de grid para las imágenes -->
                <div class="p-6" id="grid-view">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($carouselImages as $image)
                            <div class="group relative bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 hover:border-purple-300 overflow-hidden transform hover:-translate-y-1">
                                
                                <!-- Imagen principal -->
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         alt="{{ $image->title }}" 
                                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                    
                                    <!-- Badge de orden -->
                                    <div class="absolute top-4 left-4">
                                        <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                            #{{ $image->order }}
                                        </div>
                                    </div>

                                    <!-- Estado activo (si tienes campo active) -->
                                    @if(isset($image->active))
                                        <div class="absolute top-4 right-4">
                                            @if($image->active)
                                                <div class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-semibold shadow-lg">
                                                    <i class="fas fa-eye mr-1"></i> Activa
                                                </div>
                                            @else
                                                <div class="bg-gray-500 text-white px-2 py-1 rounded-full text-xs font-semibold shadow-lg">
                                                    <i class="fas fa-eye-slash mr-1"></i> Inactiva
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    <!-- Overlay con acciones -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end justify-center p-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.carousel.edit', $image) }}" 
                                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center">
                                                <i class="fas fa-edit mr-1"></i> Editar
                                            </a>
                                            <form action="{{ route('admin.carousel.destroy', $image) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" 
                                                        onclick="confirmDeleteImage(this.form, '{{ $image->title }}')"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center">
                                                    <i class="fas fa-trash mr-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Información de la imagen -->
                                <div class="p-4">
                                    <h4 class="font-bold text-gray-900 text-lg mb-2 truncate">{{ $image->title }}</h4>
                                    
                                    @if(isset($image->description))
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $image->description }}</p>
                                    @endif

                                    <!-- Información adicional -->
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <i class="fas fa-sort-numeric-down mr-1"></i>
                                            Orden: {{ $image->order }}
                                        </div>
                                        
                                        @if(isset($image->created_at))
                                            <div class="flex items-center">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $image->created_at->format('d/m/Y') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Vista de tabla alternativa (oculta por defecto, puedes activarla con un toggle) -->
                <div class="hidden" id="table-view">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Imagen</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Título</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Orden</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($carouselImages as $image)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}" class="h-16 w-24 object-cover rounded-lg shadow-md">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $image->title }}</div>
                                        @if(isset($image->description))
                                            <div class="text-sm text-gray-500">{{ Str::limit($image->description, 50) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                            #{{ $image->order }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(isset($image->active))
                                            @if($image->active)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-circle text-green-400 mr-1 text-xs"></i>
                                                    Activa
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    <i class="fas fa-circle text-gray-400 mr-1 text-xs"></i>
                                                    Inactiva
                                                </span>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-circle text-blue-400 mr-1 text-xs"></i>
                                                Configurar
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('admin.carousel.edit', $image) }}" 
                                               class="bg-blue-100 hover:bg-blue-200 text-blue-600 px-3 py-2 rounded-lg text-xs font-semibold transition-colors">
                                                <i class="fas fa-edit mr-1"></i> Editar
                                            </a>
                                            <form action="{{ route('admin.carousel.destroy', $image) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" 
                                                        onclick="confirmDeleteImage(this.form, '{{ $image->title }}')"
                                                        class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded-lg text-xs font-semibold transition-colors">
                                                    <i class="fas fa-trash mr-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                <!-- Estado vacío mejorado -->
                <div class="text-center py-16 px-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-images text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay imágenes en el carrusel</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Comienza añadiendo tu primera imagen para crear un carrusel atractivo en tu página principal.
                    </p>
                    <a href="{{ route('admin.carousel.create') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>
                        Añadir Primera Imagen
                    </a>
                </div>
            @endif

            <!-- Footer con acciones adicionales -->
            @if ($carouselImages->count() > 0)
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-2"></i>
                            {{ $carouselImages->count() }} imagen{{ $carouselImages->count() !== 1 ? 'es' : '' }} en total
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <!-- Toggle para cambiar vista -->
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-600">Vista:</span>
                                <div class="flex bg-gray-200 rounded-lg p-1">
                                    <button onclick="showGridView()" id="grid-btn" class="px-3 py-1 rounded-md bg-white shadow-sm text-sm font-medium text-purple-600 transition-all">
                                        <i class="fas fa-th mr-1"></i> Tarjetas
                                    </button>
                                    <button onclick="showTableView()" id="table-btn" class="px-3 py-1 rounded-md text-sm text-gray-500 hover:text-gray-700 transition-colors">
                                        <i class="fas fa-list mr-1"></i> Lista
                                    </button>
                                </div>
                            </div>
                            
                            <a href="{{ route('admin.dashboard') }}" 
                               class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold text-sm transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Volver al Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex justify-center">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold text-sm transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Volver al Dashboard
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

@push('scripts')
<script>
    // Toggle entre vista de tarjetas y tabla
    function showGridView() {
        document.getElementById('grid-view').classList.remove('hidden');
        document.getElementById('table-view').classList.add('hidden');
        
        // Actualizar botones
        document.getElementById('grid-btn').className = 'px-3 py-1 rounded-md bg-white shadow-sm text-sm font-medium text-purple-600 transition-all';
        document.getElementById('table-btn').className = 'px-3 py-1 rounded-md text-sm text-gray-500 hover:text-gray-700 transition-colors';
        
        // Guardar preferencia
        localStorage.setItem('carousel_view', 'grid');
    }

    function showTableView() {
        document.getElementById('grid-view').classList.add('hidden');
        document.getElementById('table-view').classList.remove('hidden');
        
        // Actualizar botones
        document.getElementById('table-btn').className = 'px-3 py-1 rounded-md bg-white shadow-sm text-sm font-medium text-purple-600 transition-all';
        document.getElementById('grid-btn').className = 'px-3 py-1 rounded-md text-sm text-gray-500 hover:text-gray-700 transition-colors';
        
        // Guardar preferencia
        localStorage.setItem('carousel_view', 'table');
    }

    // Cargar preferencia de vista al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('carousel_view') || 'grid';
        if (savedView === 'table') {
            showTableView();
        } else {
            showGridView();
        }
    });

    // Confirmación mejorada para eliminar
    function confirmDelete(imageName) {
        return confirm(`¿Estás seguro de que quieres eliminar la imagen "${imageName}"?\n\nEsta acción no se puede deshacer.`);
    }

    // Auto-hide para mensajes de éxito después de 5 segundos
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.querySelector('[x-data*="show: true"]');
        if (successMessage) {
            setTimeout(function() {
                // Trigger Alpine.js para ocultar el mensaje
                const event = new CustomEvent('click');
                const closeButton = successMessage.querySelector('button');
                if (closeButton) {
                    closeButton.dispatchEvent(event);
                }
            }, 5000);
        }
    });

    // Lazy loading para imágenes (mejora de performance)
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('img[data-src]');
        if (images.length > 0) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        }
    });

    // Animación de entrada para las tarjetas
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('#grid-view .group');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });

    // Búsqueda en tiempo real (función preparada)
    function filterImages(searchTerm) {
        const cards = document.querySelectorAll('#grid-view .group');
        const rows = document.querySelectorAll('#table-view tbody tr');
        
        searchTerm = searchTerm.toLowerCase();
        
        // Filtrar vista de tarjetas
        cards.forEach(card => {
            const title = card.querySelector('h4').textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
        
        // Filtrar vista de tabla
        rows.forEach(row => {
            const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Drag and drop para reordenar (funcionalidad avanzada)
    function initDragAndDrop() {
        const cards = document.querySelectorAll('#grid-view .group');
        
        cards.forEach(card => {
            card.draggable = true;
            card.addEventListener('dragstart', handleDragStart);
            card.addEventListener('dragover', handleDragOver);
            card.addEventListener('drop', handleDrop);
            card.addEventListener('dragend', handleDragEnd);
        });
    }

    let draggedElement = null;

    function handleDragStart(e) {
        draggedElement = this;
        this.style.opacity = '0.5';
    }

    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        return false;
    }

    function handleDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }

        if (draggedElement !== this) {
            // Aquí puedes implementar la lógica para reordenar
            // y enviar una petición AJAX para actualizar el orden en la base de datos
            console.log('Reordenar elementos:', {
                from: draggedElement.dataset.imageId,
                to: this.dataset.imageId
            });
            
            // Ejemplo de petición AJAX para actualizar orden:
            /*
            fetch('/admin/carousel/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    from: draggedElement.dataset.imageId,
                    to: this.dataset.imageId
                })
            });
            */
        }
        return false;
    }

    function handleDragEnd(e) {
        this.style.opacity = '1';
        draggedElement = null;
    }

    // Previsualización de imagen antes de subir (para formularios)
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                if (preview) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Función para confirmar eliminación con nombre de imagen
    function confirmDeleteImage(form, imageName) {
        if (confirm(`¿Estás seguro de que quieres eliminar la imagen "${imageName}"?\n\nEsta acción no se puede deshacer.`)) {
            form.submit();
        }
        return false;
    }
</script>
@endpush

</x-admin-layout>