<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sala de Evaluación') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- 1. KPI CARDS (Stats) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between group hover:border-indigo-500 transition-colors duration-300">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Proyectos</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $totalProyectos }}</h3>
                    </div>
                    <div class="p-4 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between group hover:border-green-500 transition-colors duration-300">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Calificados</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $proyectosEvaluados }}</h3>
                    </div>
                    <div class="p-4 bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-xl group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between group hover:border-yellow-500 transition-colors duration-300">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pendientes</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $pendientes }}</h3>
                    </div>
                    <div class="p-4 bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 rounded-xl group-hover:bg-yellow-500 group-hover:text-white transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            {{-- 2. EVENTOS ACTIVOS --}}
            <div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Eventos Asignados
                </h3>

                @if($eventos->count() > 0)
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        @foreach($eventos as $evento)
                            <div class="flex flex-col bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                                
                                <div class="p-6 flex-1">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-1">{{ $evento->nombre }}</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ $evento->descripcion }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                            {{ $evento->proyectos_count }} Proyectos
                                        </span>
                                    </div>

                                    <div class="mt-4">
                                        
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                            <div class="bg-indigo-600 h-1.5 rounded-full" style="width: 0%"></div> {{-- Ajustar width dinámicamente --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 dark:bg-gray-700/30 px-6 py-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 font-medium">
                                        <svg class="w-4 h-4 mr-1.5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Cierre: {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}
                                    </div>
                                    
                                    <a href="{{ route('juez.evento.show', $evento) }}" class="inline-flex items-center text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors">
                                        Entrar a Evaluar
                                        <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-12 text-center border border-dashed border-gray-300 dark:border-gray-700">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Sin eventos asignados</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No tienes eventos activos para evaluar en este momento.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>