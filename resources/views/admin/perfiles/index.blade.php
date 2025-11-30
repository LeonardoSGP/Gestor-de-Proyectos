<x-app-layout>
    <div class="mx-auto max-w-7xl">
        {{-- Encabezado --}}
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-2xl">
                Gestión de Perfiles
            </h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li class="font-medium text-indigo-600">Perfiles</li>
                </ol>
            </nav>
        </div>

        {{-- Alertas --}}
        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Contenedor Tabla --}}
        <div class="rounded-sm border border-gray-200 bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-gray-700 dark:bg-gray-800 sm:px-7.5 xl:pb-1 sm: rounded-3xl">
            
            {{-- Toolbar --}}
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                {{-- Buscador --}}
                <form action="{{ route('admin.perfiles.index') }}" method="GET" class="relative w-full sm:w-64">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar perfil..." 
                        class="w-full rounded border-[1.5px] border-gray-300 bg-transparent py-2 pl-10 pr-4 font-medium outline-none transition focus:border-indigo-600 active:border-indigo-600 disabled:cursor-default disabled:bg-whiter dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-indigo-600">
                </form>

                {{-- Botón Nuevo --}}
                <a href="{{ route('admin.perfiles.create') }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 py-2 px-6 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 gap-2 transition hover:bg-indigo-700">
                    <span>+</span> Nuevo Perfil
                </a>
            </div>

            {{-- Tabla --}}
            <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-2 text-left dark:bg-meta-4">
                            <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                                Nombre del Perfil
                            </th>
                            <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
                                Fecha Creación
                            </th>
                            <th class="py-4 px-4 font-medium text-black dark:text-white text-right">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($perfiles as $perfil)
                            <tr class="border-b border-gray-100 dark:border-gray-700 last:border-b-0 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="py-5 px-4 pl-9 xl:pl-11">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-indigo-50 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-lg">
                                            {{ substr($perfil->nombre, 0, 1) }}
                                        </div>
                                        <h5 class="font-medium text-black dark:text-white">{{ $perfil->nombre }}</h5>
                                    </div>
                                </td>
                                <td class="py-5 px-4">
                                    <p class="text-black dark:text-white">{{ $perfil->created_at->format('d M, Y') }}</p>
                                </td>
                                <td class="py-5 px-4 text-right">
                                    <div class="flex items-center justify-end space-x-3.5">
                                        <a href="{{ route('admin.perfiles.edit', $perfil) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 text-gray-500 transition">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </a>
                                        
                                        {{-- Botón eliminar con confirmación simple --}}
                                        <form action="{{ route('admin.perfiles.destroy', $perfil) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="hover:text-red-600 dark:hover:text-red-400 text-gray-500 transition" onclick="return confirm('¿Eliminar este perfil? Esto podría afectar a equipos existentes.')">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="py-6 px-4">
                {{ $perfiles->links('components.pagination') }}
            </div>
        </div>
    </div>
</x-app-layout>