<x-app-layout>
    <div class="mx-auto max-w-270">
        
        {{-- Breadcrumb --}}
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-2xl">Nuevo Perfil</h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li><a class="font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600" href="{{ route('admin.perfiles.index') }}">Perfiles /</a></li>
                    <li class="font-medium text-indigo-600">Crear</li>
                </ol>
            </nav>
        </div>

        {{-- Card Formulario --}}
        <div class="rounded-sm border border-gray-200 bg-white shadow-default dark:border-gray-700 dark:bg-gray-800 sm: p-5 rounded-3xl">
            <div class="border-b border-gray-200 py-4 px-6.5 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Datos del Perfil</h3>
            </div>
            
            <form action="{{ route('admin.perfiles.store') }}" method="POST">
                @csrf
                <div class="p-6.5">
                    
                    <div class="mb-4.5">
                        <label class="mb-2.5 block text-black dark:text-white font-medium">
                            Nombre del Perfil <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ej. Programador Backend, Diseñador UX..." required autofocus
                                class="w-full rounded border-[1.5px] bg-transparent py-3 px-5 font-medium outline-none transition disabled:cursor-default disabled:bg-whiter dark:bg-gray-700
                                {{ $errors->has('nombre') 
                                    ? 'border-red-500 text-red-900 focus:border-red-500 focus:ring-red-500 dark:border-red-500 dark:text-red-500' 
                                    : 'border-gray-300 text-black focus:border-indigo-600 dark:border-gray-600 dark:text-white dark:focus:border-indigo-600' 
                                }}" />
                            
                            @error('nombre')
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                </div>
                            @enderror
                        </div>
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2 text-red-500" />
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Este es el rol técnico que seleccionarán los alumnos al unirse a un equipo.</p>
                    </div>

                    <div class="flex justify-end gap-4.5 mt-8">
                        <a href="{{ route('admin.perfiles.index') }}" class="flex justify-center rounded border border-gray-300 py-2 px-6 font-medium text-gray-700 hover:shadow-sm dark:border-gray-600 dark:text-gray-300 dark:hover:text-white transition">
                            Cancelar
                        </a>
                        <button type="submit" class="flex justify-center rounded bg-indigo-600 py-2 px-6 font-medium text-white hover:bg-opacity-90 hover:bg-indigo-700 transition shadow-md">
                            Guardar Perfil
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>