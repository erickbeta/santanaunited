<x-app-layout>
{{-- En resources/views/welcome.blade.php --}}

<div class="relative text-white">
    {{-- Carrusel nativo simple --}}
    <div class="relative w-full h-64 md:h-80 lg:h-96 overflow-hidden carousel-container">
        @foreach ($carouselImages as $index => $image)
            <div class="carousel-slide absolute inset-0 transition-all duration-700 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" 
                 data-slide="{{ $index }}">
                <img src="{{ asset('storage/' . $image->image_path) }}" 
                     alt="{{ $image->title ?? 'Carousel Image' }}" 
                     class="w-full h-auto object-contain transform transition-transform duration-300 hover:scale-105">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/75 to-transparent"></div>
                
                {{-- Opcional: Título y descripción --}}
                @if($image->title || $image->description)
                    <div class="absolute bottom-0 left-0 right-0 p-6 z-10">
                        @if($image->title)
                            <h3 class="text-2xl md:text-3xl font-bold mb-2">{{ $image->title }}</h3>
                        @endif
                        @if($image->description)
                            <p class="text-sm md:text-base opacity-90">{{ $image->description }}</p>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach

        {{-- Solo mostrar controles si hay más de 1 imagen --}}
        @if(count($carouselImages) > 1)
            {{-- Botones de navegación --}}
            <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white p-3 rounded-full transition-all duration-200 z-20 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white p-3 rounded-full transition-all duration-200 z-20 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            {{-- Indicadores --}}
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
                @foreach($carouselImages as $index => $image)
                    <button class="carousel-dot w-3 h-3 rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}" 
                            data-slide="{{ $index }}"></button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Contenido superpuesto --}}
    <div class="absolute inset-0 flex flex-col items-center justify-end z-30 pb-16 md:pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4" style="filter: drop-shadow(0 10px 8px rgb(0 0 0 / 0.4));">Welcome to Santana United</h1>
                <p class="text-xl md:text-2xl mb-8" style="filter: drop-shadow(0 4px 3px rgb(0 0 0 / 0.3));">Your club, Your Family.</p>
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('games.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-full text-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                        Ver Próximos Partidos
                    </a>
                    <a href="{{ route('posts.index') }}" class="bg-white/90 hover:bg-white text-blue-900 font-semibold px-8 py-3 rounded-full text-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                        Últimas Noticias
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- El resto de tu contenido sigue igual --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <a href="{{ route('games.index') }}" class="bg-green-500 hover:bg-green-600 text-white p-6 rounded-lg transition-colors shadow-lg">
            <div class="flex items-center">
                <i class="fa-solid fa-futbol mr-3 text-3xl"></i>
                <div>
                    <h3 class="font-bold text-lg">Partidos</h3>
                    <p class="text-sm opacity-90">Ver calendario</p>
                </div>
            </div>
        </a>
        <a href="{{ route('posts.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-6 rounded-lg transition-colors shadow-lg">
            <div class="flex items-center">
               <i class="fa-solid fa-exclamation mr-5 text-3xl"></i>
               <div>
                   <h3 class="font-bold text-lg">Noticias</h3>
                   <p class="text-sm opacity-90">Últimas novedades</p>
               </div>
            </div>
        </a>
        <a href="{{ route('players.index') }}" class="bg-red-500 hover:bg-red-600 text-white p-6 rounded-lg transition-colors shadow-lg">
             <div class="flex items-center">
                <i class="fa-solid fa-users mr-3 text-3xl"></i>
                <div>
                    <h3 class="font-bold text-lg">Plantilla</h3>
                    <p class="text-sm opacity-90">Ver jugadores</p>
                </div>
            </div>
        </a>
        <a href="{{ route('stats.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white p-6 rounded-lg transition-colors shadow-lg">
            <div class="flex items-center">
                <i class="fa-solid fa-chart-bar mr-3 text-3xl"></i>
                <div>
                    <h3 class="font-bold text-lg">Estadísticas</h3>
                    <p class="text-sm opacity-90">Ver números</p>
                </div>
            </div>
        </a>
    </div>

</div>

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    // Solo ejecutar si hay slides
    if (slides.length === 0) return;
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    let autoplayInterval;

    // Función para mostrar slide
    function showSlide(index) {
        // Ocultar todos los slides
        slides.forEach(slide => {
            slide.classList.remove('opacity-100', 'z-10');
            slide.classList.add('opacity-0', 'z-0');
        });
        
        // Mostrar slide actual
        slides[index].classList.remove('opacity-0', 'z-0');
        slides[index].classList.add('opacity-100', 'z-10');
        
        // Actualizar dots
        dots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.remove('bg-white/50');
                dot.classList.add('bg-white');
            } else {
                dot.classList.remove('bg-white');
                dot.classList.add('bg-white/50');
            }
        });
    }

    // Siguiente slide
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    // Slide anterior
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    // Autoplay
    function startAutoplay() {
        if (totalSlides > 1) {
            autoplayInterval = setInterval(nextSlide, 5000);
        }
    }

    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }

    // Event listeners
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            stopAutoplay();
            startAutoplay();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            stopAutoplay();
            startAutoplay();
        });
    }

    // Dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
            stopAutoplay();
            startAutoplay();
        });
    });

    

    // Teclado
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            prevSlide();
            stopAutoplay();
            startAutoplay();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
            stopAutoplay();
            startAutoplay();
        }
    });

    // Iniciar
    startAutoplay();
});
</script>

{{-- Responsive para móviles --}}
@media (max-width: 640px) {
    .carousel-container { height: 200px !important; }
}
</style>
@endpush
</x-app-layout>