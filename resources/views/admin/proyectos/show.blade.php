<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalle de Evaluación') }}
            </h2>
            <a href="{{ route('admin.proyectos.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- COLUMNA IZQUIERDA: DATOS DEL PROYECTO (Sticky) --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden sticky top-8">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/20">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Proyecto</h3>
                            <h1 class="text-xl font-bold text-gray-900 dark:text-white leading-tight">{{ $proyecto->nombre }}</h1>
                        </div>
                        
                        <div class="p-6 space-y-6">
                            <div>
                                <h4 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">Descripción</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                                    {{ $proyecto->descripcion ?? 'Sin descripción registrada.' }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Equipo</span>
                                    @if($proyecto->equipo)
                                        <span class="text-xs bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300 px-2 py-1 rounded font-bold">
                                            {{ $proyecto->equipo->participantes->count() }} Miembros
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                        {{ substr($proyecto->equipo->nombre ?? 'S', 0, 1) }}
                                    </div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">
                                        {{ $proyecto->equipo->nombre ?? 'Sin Equipo Asignado' }}
                                    </p>
                                </div>
                            </div>

                            @if($proyecto->repositorio_url)
                                <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                                    <a href="{{ $proyecto->repositorio_url }}" target="_blank" class="flex items-center justify-center w-full py-2.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-xl text-sm font-bold transition-colors gap-2">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                        Ver Repositorio
                                    </a>
                                </div>
                            @endif

                            <div class="pt-2">
                                <a href="{{ route('admin.proyectos.edit', $proyecto) }}" class="flex items-center justify-center w-full py-2.5 border-2 border-dashed border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-xl text-sm font-bold transition-all">
                                    Editar Información
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- COLUMNA DERECHA: RESULTADOS (2 cols) --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- 1. KPI RESULTADO FINAL --}}
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 flex flex-col md:flex-row justify-between items-center bg-indigo-600 text-white relative overflow-hidden">
                            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                            
                            <div class="relative z-10">
                                <h3 class="text-lg font-bold opacity-90">Calificación Final</h3>
                                <p class="text-xs opacity-75 mt-1">Promedio ponderado de todas las evaluaciones.</p>
                            </div>
                            
                            <div class="relative z-10 flex items-end gap-2 mt-4 md:mt-0">
                                <span class="text-5xl font-black tracking-tight">{{ number_format($puntajeTotal, 1) }}</span>
                                <span class="text-lg font-medium opacity-75 mb-2">/ 100</span>
                            </div>
                        </div>

                        <div class="p-6">
                            @if(count($desglosePuntaje) > 0)
                                <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Criterio</th>
                                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Peso</th>
                                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Promedio Jueces</th>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Puntos Reales</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                                            @foreach($desglosePuntaje as $fila)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/20 transition-colors">
                                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $fila['criterio'] }}
                                                    </td>
                                                    <td class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                                            {{ $fila['ponderacion'] }}%
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 text-center text-sm font-bold text-blue-600 dark:text-blue-400">
                                                        {{ $fila['promedio_jueces'] }}
                                                    </td>
                                                    <td class="px-6 py-4 text-right text-sm font-black text-gray-900 dark:text-white">
                                                        {{ $fila['puntos_reales'] }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-100 dark:border-yellow-900/20 rounded-xl flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-xs text-yellow-700 dark:text-yellow-400">
                                        <strong>¿Cómo se calcula?</strong> El "Promedio Jueces" es la calificación media (0-100) otorgada por todos los evaluadores en ese criterio. Los "Puntos Reales" son el resultado de aplicar la ponderación (Peso) a ese promedio.
                                    </p>
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-12">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <h3 class="text-gray-900 dark:text-white font-bold">Sin Evaluaciones</h3>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Este proyecto aún no ha sido calificado por los jueces.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>