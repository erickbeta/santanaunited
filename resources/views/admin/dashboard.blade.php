<x-admin-layout :title="'Dashboard'">

    <div class="container mx-auto">
        <div class="p-6 mb-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800">¡Bienvenido al Panel de Administrador!</h2>
            <p class="mt-2 text-gray-600">Desde aquí podrás gestionar todo el contenido del sitio y la aplicación del club.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Gestionar Carrusel</h3>
                <p class="mt-2 text-gray-600">Administra las imágenes de la página principal.</p>
                <a href="{{ route('admin.carousel.index') }}" class="inline-block mt-4 text-blue-500 hover:text-blue-700 font-semibold">
                    Ir al Carrusel &rarr;
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Gestionar Equipos</h3>
                <p class="mt-2 text-gray-600">Crea, edita y elimina los equipos del club.</p>
                <a href="#" class="inline-block mt-4 text-blue-500 hover:text-blue-700 font-semibold">
                    Ir a Equipos &rarr;
                </a>
            </div>
        </div>
    </div>

</x-admin-layout>