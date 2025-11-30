<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resultados y Ganadores') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- 1. FILTRO DE EVENTO (Aumenté el mb-12 para separar del podio) --}}
            <div
                class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row items-center justify-between gap-4 mb-12 relative z-20">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white">Seleccionar Evento</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Visualiza el ranking por competencia</p>
                    </div>
                </div>

                <form action="{{ route('admin.resultados.index') }}" method="GET" class="w-full md:w-auto">
                    <div class="relative">
                        <select name="evento_id" onchange="this.form.submit()"
                            class="w-full md:w-64 pl-4 pr-10 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 cursor-pointer appearance-none shadow-sm transition-all">
                            @foreach ($eventos as $ev)
                                <option value="{{ $ev->id }}"
                                    {{ $evento && $evento->id == $ev->id ? 'selected' : '' }}>
                                    {{ $ev->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>

            @if ($ranking->isEmpty())
                <div
                    class="flex flex-col items-center justify-center py-20 bg-white dark:bg-gray-800 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-full mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Sin Resultados</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center max-w-sm mt-1">Aún no hay
                        calificaciones suficientes para generar el ranking de este evento.</p>
                </div>
            @else
                {{-- 2. PODIO DE GANADORES (TOP 3) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end mb-16 relative z-10 px-4 md:px-0">

                    {{-- 2do Lugar (Plata) --}}
                    @if (isset($ranking[1]))
                        <div class="order-2 md:order-1 relative group h-full">
                            <div
                                class="absolute inset-0 bg-gradient-to-b from-gray-200 via-gray-300 to-gray-400 rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity duration-500">
                            </div>

                            <div
                                class="relative bg-white dark:bg-gray-800 rounded-3xl p-6 border-t-4 border-gray-400 shadow-xl hover:-translate-y-2 transition-transform duration-300 flex flex-col items-center text-center h-full">
                                <div class="mb-5 relative">
                                    <div
                                        class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-3xl font-black text-gray-400 shadow-inner ring-4 ring-white dark:ring-gray-800 group-hover:scale-110 transition-transform">
                                        2
                                    </div>
                                    <div
                                        class="absolute -bottom-1 -right-1 bg-white dark:bg-gray-800 rounded-full p-1 shadow-sm">
                                        <svg class="w-5 h-5 text-gray-400 fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </div>
                                </div>

                                <h3
                                    class="text-lg font-bold text-gray-900 dark:text-white line-clamp-2 mb-1 leading-tight">
                                    {{ $ranking[1]->nombre }}</h3>
                                <p
                                    class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold mb-6">
                                    {{ $ranking[1]->equipo }}</p>

                                <div class="mt-auto w-full">
                                    <div
                                        class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 rounded-2xl border border-gray-100 dark:border-gray-700 mb-6">
                                        <span
                                            class="text-3xl font-black text-gray-600 dark:text-gray-300 tracking-tight">{{ number_format($ranking[1]->puntaje, 1) }}</span>
                                        <span
                                            class="text-[10px] text-gray-400 uppercase font-bold block -mt-1">Puntos</span>
                                    </div>

                                    {{-- BOTÓN MINIMALISTA (SOLO ICONO) --}}
                                    <a href="{{ route('admin.constancia.descargar', ['proyecto' => $ranking[1]->id, 'posicion' => 2]) }}"
                                        target="_blank"
                                        class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 hover:bg-gray-200 text-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-300 rounded-full shadow-lg hover:shadow-xl hover:scale-110 transition-all duration-300"
                                        title="Descargar Constancia">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- 1er Lugar (Oro - Más Grande) --}}
                    @if (isset($ranking[0]))
                        <div class="order-1 md:order-2 relative group z-20 -mt-12 md:-mt-20 h-full">
                            <div
                                class="absolute inset-0 bg-gradient-to-b from-yellow-300 via-yellow-500 to-yellow-600 rounded-3xl blur-2xl opacity-40 group-hover:opacity-60 transition-opacity duration-500 animate-pulse-slow">
                            </div>

                            <div
                                class="relative bg-white dark:bg-gray-800 rounded-3xl p-8 border-t-4 border-yellow-400 shadow-2xl hover:-translate-y-3 transition-transform duration-300 flex flex-col items-center text-center h-full transform scale-105">
                                <div class="mb-6 relative">
                                    <div
                                        class="w-24 h-24 rounded-full bg-gradient-to-br from-yellow-100 to-yellow-50 dark:from-yellow-900/40 dark:to-yellow-800/20 flex items-center justify-center text-5xl font-black text-yellow-500 shadow-inner ring-4 ring-white dark:ring-gray-800 group-hover:rotate-12 transition-transform duration-500">
                                        1
                                    </div>
                                    <div
                                        class="absolute -bottom-2 -right-2 bg-white dark:bg-gray-800 rounded-full p-2 shadow-lg">
                                        <svg class="w-8 h-8 text-yellow-400 fill-current animate-bounce"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </div>
                                </div>

                                <h3
                                    class="text-2xl font-extrabold text-gray-900 dark:text-white line-clamp-2 mb-2 leading-tight">
                                    {{ $ranking[0]->nombre }}</h3>
                                <p
                                    class="text-sm text-yellow-600 dark:text-yellow-400 uppercase tracking-widest font-bold mb-8">
                                    {{ $ranking[0]->equipo }}</p>

                                <div class="mt-auto w-full">
                                    <div
                                        class="bg-yellow-50 dark:bg-yellow-900/20 px-6 py-4 rounded-2xl border border-yellow-200 dark:border-yellow-700/50 mb-8">
                                        <span
                                            class="text-5xl font-black text-yellow-600 dark:text-yellow-400 tracking-tighter">{{ number_format($ranking[0]->puntaje, 1) }}</span>
                                        <span class="text-xs text-yellow-600/70 uppercase font-bold block -mt-1">Puntos
                                            Totales</span>
                                    </div>

                                    {{-- BOTÓN MINIMALISTA (ORO - DESTACADO) --}}
                                    <a href="{{ route('admin.constancia.descargar', ['proyecto' => $ranking[0]->id, 'posicion' => 1]) }}"
                                        target="_blank"
                                        class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-white rounded-full shadow-lg hover:shadow-yellow-500/50 hover:scale-110 transition-all duration-300 ring-4 ring-white dark:ring-gray-800"
                                        title="Descargar Constancia de Ganador">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- 3er Lugar (Bronce) --}}
                    @if (isset($ranking[2]))
                        <div class="order-3 md:order-3 relative group h-full">
                            <div
                                class="absolute inset-0 bg-gradient-to-b from-orange-200 via-orange-300 to-orange-400 rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity duration-500">
                            </div>

                            <div
                                class="relative bg-white dark:bg-gray-800 rounded-3xl p-6 border-t-4 border-orange-400 shadow-xl hover:-translate-y-2 transition-transform duration-300 flex flex-col items-center text-center h-full">
                                <div class="mb-5 relative">
                                    <div
                                        class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-3xl font-black text-orange-400 shadow-inner ring-4 ring-white dark:ring-gray-800 group-hover:scale-110 transition-transform">
                                        3
                                    </div>
                                    <div
                                        class="absolute -bottom-1 -right-1 bg-white dark:bg-gray-800 rounded-full p-1 shadow-sm">
                                        <svg class="w-5 h-5 text-orange-400 fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </div>
                                </div>

                                <h3
                                    class="text-lg font-bold text-gray-900 dark:text-white line-clamp-2 mb-1 leading-tight">
                                    {{ $ranking[2]->nombre }}</h3>
                                <p
                                    class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold mb-6">
                                    {{ $ranking[2]->equipo }}</p>

                                <div class="mt-auto w-full">
                                    <div
                                        class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 rounded-2xl border border-gray-100 dark:border-gray-700 mb-6">
                                        <span
                                            class="text-3xl font-black text-orange-600 dark:text-orange-400 tracking-tight">{{ number_format($ranking[2]->puntaje, 1) }}</span>
                                        <span
                                            class="text-[10px] text-gray-400 uppercase font-bold block -mt-1">Puntos</span>
                                    </div>

                                    {{-- BOTÓN MINIMALISTA (BRONCE) --}}
                                    <a href="{{ route('admin.constancia.descargar', ['proyecto' => $ranking[2]->id, 'posicion' => 3]) }}"
                                        target="_blank"
                                        class="inline-flex items-center justify-center w-12 h-12 bg-orange-100 hover:bg-orange-200 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400 dark:hover:bg-orange-900/50 rounded-full shadow-lg hover:shadow-xl hover:scale-110 transition-all duration-300"
                                        title="Descargar Constancia">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- 3. TABLA RESTANTE (Puestos 4 en adelante) --}}
                @if ($ranking->count() > 3)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/30">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Resto de Participantes</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="bg-gray-50 dark:bg-gray-700/50 text-xs uppercase text-gray-500 dark:text-gray-400 font-semibold tracking-wider">
                                        <th class="px-6 py-4 text-center w-20">#</th>
                                        <th class="px-6 py-4">Proyecto / Equipo</th>
                                        <th class="px-6 py-4 text-center">Puntaje</th>
                                        <th class="px-6 py-4 text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @foreach ($ranking->slice(3) as $index => $item)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/20 transition-colors">
                                            <td class="px-6 py-4 text-center font-bold text-gray-400 text-lg">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="font-bold text-gray-900 dark:text-white text-sm">
                                                    {{ $item->nombre }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $item->equipo }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-bold">
                                                    {{ $item->puntaje }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <a href="{{ route('admin.constancia.descargar', ['proyecto' => $item->id, 'posicion' => $index + 1]) }}"
                                                    target="_blank"
                                                    class="text-xs text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 font-bold hover:underline inline-flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                    Constancia
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

            @endif
        </div>
    </div>
</x-app-layout>
