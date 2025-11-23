<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Evaluando: <span class="text-indigo-600">{{ $proyecto->nombre }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Info del Proyecto --}}
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <p class="text-gray-600 mb-2">{{ $proyecto->descripcion }}</p>
                @if($proyecto->repositorio_url)
                    <a href="{{ $proyecto->repositorio_url }}" target="_blank" class="text-blue-600 underline text-sm">Ver Repositorio de Código</a>
                @endif
            </div>

            <form method="POST" action="{{ route('juez.evaluacion.store', $proyecto) }}">
                @csrf
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 border-b pb-2">Rúbrica de Evaluación</h3>

                    @if($proyecto->evento->criterios->isEmpty())
                        <div class="text-red-500 p-4 bg-red-50 rounded">
                            Error: El administrador no ha definido criterios para este evento. No se puede calificar.
                        </div>
                    @else
                        <div class="space-y-8">
                            @foreach($proyecto->evento->criterios as $criterio)
                                @php
                                    // Buscar si ya hay nota guardada
                                    $valorPrevio = $calificacionesPrevias[$criterio->id]->puntuacion ?? 0;
                                @endphp

                                <div x-data="{ score: {{ $valorPrevio }} }" class="border-b border-gray-100 pb-6 last:border-0">
                                    <div class="flex justify-between items-center mb-2">
                                        <div>
                                            <label class="text-lg font-medium text-gray-800">{{ $criterio->nombre }}</label>
                                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded ml-2">Peso: {{ $criterio->ponderacion }}%</span>
                                        </div>
                                        <div class="text-2xl font-bold text-indigo-600">
                                            <span x-text="score"></span><span class="text-sm text-gray-400">/100</span>
                                        </div>
                                    </div>

                                    {{-- Slider Input --}}
                                    <input type="range" min="0" max="100" x-model="score" 
                                        name="puntuaciones[{{ $criterio->id }}]" 
                                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600">
                                    
                                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                                        <span>0 (Malo)</span>
                                        <span>50 (Regular)</span>
                                        <span>100 (Excelente)</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8 flex justify-end gap-4">
                            <a href="{{ route('juez.dashboard') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Cancelar</a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded font-bold hover:bg-indigo-500 shadow transition">
                                Guardar Evaluación
                            </button>
                        </div>
                    @endif
                </div>
            </form>

        </div>
    </div>
</x-app-layout>