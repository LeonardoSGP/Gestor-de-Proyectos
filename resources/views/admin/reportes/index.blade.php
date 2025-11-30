<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Encabezado --}}
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Generación de Reportes</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Descarga reportes en formato PDF con todos los datos del sistema</p>
            </div>

            {{-- Grid de Tarjetas de Reportes --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- Reporte de Usuarios --}}
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-50 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalUsuarios }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Usuarios</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Listado completo de usuarios con roles y datos</p>
                    <a href="{{ route('admin.reportes.usuarios.pdf') }}" 
                       class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 py-2.5 px-4 text-sm font-medium text-white hover:bg-indigo-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descargar PDF
                    </a>
                </div>

                {{-- Reporte de Equipos --}}
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalEquipos }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Equipos</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Equipos con integrantes y proyectos asignados</p>
                    <a href="{{ route('admin.reportes.equipos.pdf') }}" 
                       class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 py-2.5 px-4 text-sm font-medium text-white hover:bg-blue-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descargar PDF
                    </a>
                </div>

                {{-- Reporte de Eventos --}}
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-purple-50 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalEventos }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Eventos</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Eventos con fechas, criterios y proyectos</p>
                    <a href="{{ route('admin.reportes.eventos.pdf') }}" 
                       class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-purple-600 py-2.5 px-4 text-sm font-medium text-white hover:bg-purple-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descargar PDF
                    </a>
                </div>

                {{-- Reporte de Proyectos --}}
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalProyectos }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Proyectos</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Proyectos con equipos y calificaciones</p>
                    <a href="{{ route('admin.reportes.proyectos.pdf') }}" 
                       class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 py-2.5 px-4 text-sm font-medium text-white hover:bg-emerald-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descargar PDF
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
