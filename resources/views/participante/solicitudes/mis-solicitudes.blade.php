<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mis Solicitudes de Unión') }}
            </h2>
            <a href="{{ route('participante.dashboard') }}" 
               class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 text-green-700 dark:text-green-300 text-sm font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($solicitudes->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">No tienes solicitudes</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Aún no has enviado solicitudes para unirte a equipos.</p>
                    <a href="{{ route('participante.equipos.join') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/30 transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Enviar Solicitud
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($solicitudes as $solicitud)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            {{ $solicitud->equipo->nombre }}
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            Enviada el {{ $solicitud->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    
                                    {{-- Badge de Estado --}}
                                    <div>
                                        @if($solicitud->estado === 'pendiente')
                                            <span class="px-3 py-1 rounded-full text-sm font-bold bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800">
                                                ⏳ Pendiente
                                            </span>
                                        @elseif($solicitud->estado === 'aceptada')
                                            <span class="px-3 py-1 rounded-full text-sm font-bold bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-400 border border-green-200 dark:border-green-800">
                                                ✓ Aceptada
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-sm font-bold bg-red-100 dark:bg-red-900/20 text-red-800 dark:text-red-400 border border-red-200 dark:border-red-800">
                                                ✗ Rechazada
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Mensaje de la Solicitud --}}
                                @if($solicitud->mensaje)
                                    <div class="mb-4 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                                        <p class="text-sm text-gray-600 dark:text-gray-300">
                                            <span class="font-semibold">Tu mensaje:</span> {{ $solicitud->mensaje }}
                                        </p>
                                    </div>
                                @endif

                                {{-- Información de Respuesta --}}
                                @if($solicitud->respondida_en)
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                            Respondida por <span class="font-semibold">{{ $solicitud->respondidaPor->user->name }}</span> 
                                            el {{ $solicitud->respondida_en->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    {{-- Paginación --}}
                    <div class="mt-6">
                        {{ $solicitudes->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
