<x-admin-layout title="Gestión de Equipos">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Equipos ⚽</h1>
            <a href="{{ route('admin.teams.create') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                <i class="fas fa-plus mr-2"></i>Crear Equipo
            </a>
        </div>

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Barra de búsqueda --}}
        <div class="mb-4">
            <form action="{{ route('admin.teams.index') }}" method="GET">
                <div class="relative">
                    <input type="text" name="search" placeholder="Buscar por nombre..." value="{{ request('search') }}"
                           class="w-full border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </form>
        </div>

        {{-- Tabla de equipos --}}
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Logo</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Nombre</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Categoría</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Estado</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teams as $team)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="p-3">
                                @if ($team->logo_path)
                                    {{-- El helper asset('storage/...') crea la URL pública correcta --}}
                                    <img src="{{ asset('storage/' . $team->logo_path) }}" alt="Logo de {{ $team->name }}" class="h-12 w-12 object-contain rounded-full">
                                @else
                                    <span class="text-gray-400 text-xs">Sin logo</span>
                                @endif
                            </td>
                            <td class="p-3 text-sm text-gray-700 font-bold">{{ $team->name }}</td>
                            <td class="p-3 text-sm text-gray-700">{{ $team->category ?? 'N/A' }}</td>
                            <td class="p-3 text-sm">
                                @if ($team->is_active)
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">Activo</span>
                                @else
                                    <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full">Inactivo</span>
                                @endif
                            </td>
                            <td class="p-3">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.teams.edit', $team) }}" class="text-blue-500 hover:text-blue-700" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- El botón de eliminar debe estar en un formulario para usar el método DELETE --}}
                                    <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este equipo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-3 text-center text-gray-500">No se encontraron equipos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Paginación --}}
        <div class="mt-6">
            {{ $teams->links() }}
        </div>
    </div>
</x-admin-layout>