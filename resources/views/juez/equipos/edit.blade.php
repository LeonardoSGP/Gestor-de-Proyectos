<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Gestión de Equipo
            </h2>
            <a href="{{ route('juez.evento.show', $equipo->evento_id ?? $equipo->proyecto->evento_id) }}" 
               class="text-sm font-medium text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al Evento
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen" x-data="teamManager({{ $candidatos }})">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- 1. EDICIÓN DEL NOMBRE DEL EQUIPO --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Datos Generales</h3>
                
                <form action="{{ route('juez.equipos.update', $equipo) }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
                    @csrf @method('PUT')
                    
                    <div class="w-full md:w-1/2">
                        <label for="nombre" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre del Equipo</label>
                        <input type="text" id="nombre" name="nombre" value="{{ $equipo->nombre }}" required
                            class="w-full rounded-xl border-gray-300 dark:bg-gray-900 dark:border-gray-600 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all pl-4 pr-4 py-2.5 text-sm">
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold text-sm transition-colors shadow-md hover:shadow-lg">
                        Actualizar Nombre
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- 2. COLUMNA IZQUIERDA: AGREGAR MIEMBRO --}}
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-visible h-fit sticky top-8">
                        
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/20 rounded-t-2xl">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wide mb-4">Agregar Integrante</h3>
                            
                            @if($equipo->participantes->count() < 5)
                                <div class="relative" x-data="{ open: false }">
                                    
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                        <input type="text" 
                                               x-model="search" 
                                               @focus="open = true"
                                               @click.away="open = false"
                                               placeholder="Buscar alumno..." 
                                               class="w-full pl-10 pr-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-shadow">
                                    </div>
                                    
                                    <div x-show="search.length > 0 && filteredParticipants.length > 0" 
                                         class="absolute z-50 w-full mt-2 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-xl max-h-60 overflow-y-auto"
                                         style="display: none;"
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-100 scale-100">
                                        <template x-for="p in filteredParticipants" :key="p.id">
                                            <div @click="selectParticipant(p); open = false" 
                                                 class="px-4 py-3 hover:bg-indigo-50 dark:hover:bg-gray-700 cursor-pointer border-b last:border-0 border-gray-50 dark:border-gray-700 flex justify-between items-center group">
                                                <div>
                                                    <p class="text-sm font-bold text-gray-800 dark:text-gray-200 group-hover:text-indigo-600" x-text="p.name"></p>
                                                    <p class="text-[10px] text-gray-500 uppercase" x-text="p.carrera"></p>
                                                </div>
                                                <span class="text-[10px] bg-green-100 text-green-800 px-1.5 py-0.5 rounded font-bold">Libre</span>
                                            </div>
                                        </template>
                                    </div>

                                    <div x-show="selectedId !== null" x-transition class="mt-4 bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-xl border border-indigo-100 dark:border-indigo-800">
                                        <div class="flex justify-between items-start mb-3">
                                            <div>
                                                <p class="text-[10px] text-indigo-500 font-bold uppercase tracking-wider">Candidato</p>
                                                <p class="text-sm font-bold text-gray-900 dark:text-gray-100" x-text="selectedName"></p>
                                            </div>
                                            <button type="button" @click="resetSelection()" class="text-gray-400 hover:text-red-500 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('juez.equipos.addMember', $equipo) }}">
                                            @csrf
                                            <input type="hidden" name="participante_id" x-model="selectedId">
                                            
                                            <div class="mb-3">
                                                <label class="text-[10px] text-gray-500 uppercase font-bold block mb-1">Asignar Rol</label>
                                                <select name="perfil_id" class="w-full rounded-lg border-gray-300 dark:bg-gray-800 dark:border-gray-600 text-gray-900 dark:text-white text-xs py-2 focus:ring-indigo-500">
                                                    @foreach($perfiles as $perfil)
                                                        <option value="{{ $perfil->id }}">{{ $perfil->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-xs font-bold uppercase tracking-widest shadow-md hover:shadow-lg transition-all">
                                                Agregar al Equipo
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-3 rounded-lg text-center border border-yellow-100 dark:border-yellow-800">
                                    <span class="text-xs font-bold text-yellow-700 dark:text-yellow-400 uppercase">Equipo Completo (5/5)</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- 3. COLUMNA DERECHA: LISTA DE INTEGRANTES --}}
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <h3 class="font-bold text-gray-900 dark:text-white">Integrantes Actuales</h3>
                            <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs font-bold px-3 py-1 rounded-full">
                                {{ $equipo->participantes->count() }} Miembros
                            </span>
                        </div>
                        
                        <div class="p-6 space-y-3">
                            @foreach($equipo->participantes as $miembro)
                                <div class="flex items-center justify-between p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl border border-transparent hover:border-gray-100 dark:hover:border-gray-700 transition-all group">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                            {{ substr($miembro->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 dark:text-white leading-tight">
                                                {{ $miembro->user->name }}
                                                @if($miembro->pivot->perfil_id == 3 || $miembro->pivot->es_lider)
                                                    <span class="ml-2 text-[10px] bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300 px-1.5 py-0.5 rounded font-bold uppercase tracking-wider">Líder</span>
                                                @endif
                                            </p>
                                            <div class="flex items-center gap-2 mt-0.5">
                                                <span class="text-[10px] text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-1.5 py-0.5 rounded">{{ $miembro->carrera->nombre ?? 'N/A' }}</span>
                                                <span class="text-xs text-indigo-500 font-medium">
                                                    {{ \App\Models\Perfil::find($miembro->pivot->perfil_id)->nombre ?? 'Rol' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{ route('juez.equipos.removeMember', [$equipo, $miembro->id]) }}" method="POST" onsubmit="return confirm('¿Eliminar este miembro?');">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all opacity-0 group-hover:opacity-100" title="Eliminar del equipo">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Script Alpine --}}
    <script>
        function teamManager(participantsData) {
            return {
                search: '',
                participants: participantsData,
                selectedId: null,
                selectedName: '',

                get filteredParticipants() {
                    if (this.search === '') return [];
                    const query = this.search.toLowerCase();
                    return this.participants.filter(p => p.name.toLowerCase().includes(query) || p.no_control.toLowerCase().includes(query));
                },
                selectParticipant(p) {
                    this.selectedId = p.id;
                    this.selectedName = p.name;
                    this.search = '';
                },
                resetSelection() {
                    this.selectedId = null;
                    this.selectedName = '';
                }
            }
        }
    </script>
</x-app-layout>