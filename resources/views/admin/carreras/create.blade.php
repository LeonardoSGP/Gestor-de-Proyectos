<x-app-layout>
    <div class="mx-auto max-w-270">
        
        {{-- Breadcrumb --}}
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white text-2xl">Nueva Carrera</h2>
            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600" href="{{ route('admin.dashboard') }}">Dashboard /</a></li>
                    <li><a class="font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600" href="{{ route('admin.carreras.index') }}">Carreras /</a></li>
                    <li class="font-medium text-indigo-600">Crear</li>
                </ol>
            </nav>
        </div>

        {{-- Card Formulario --}}
        <div class="rounded-xl border border-gray-200 bg-white shadow-default dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 py-4 px-6.5 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Datos Académicos</h3>
            </div>
            
            <form action="{{ route('admin.carreras.store') }}" method="POST">
                @csrf
                <div class="p-6.5">
                    
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        {{-- Clave --}}
                        <div class="w-full xl:w-1/3">
                            <label class="mb-2.5 block text-black dark:text-white font-medium">
                                Clave / Código <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="clave" value="{{ old('clave') }}" placeholder="Ej. ISC-2025" required autofocus
                                class="w-full rounded-lg border-[1.5px] bg-transparent py-3 px-5 font-medium outline-none transition disabled:cursor-default disabled:bg-whiter dark:bg-gray-700
                                {{ $errors->has('clave') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-indigo-600 dark:border-gray-600 dark:text-white' }}" />
                            <x-input-error :messages="$errors->get('clave')" class="mt-2 text-red-500" />
                        </div>

                        {{-- Nombre --}}
                        <div class="w-full xl:w-2/3">
                            <label class="mb-2.5 block text-black dark:text-white font-medium">
                                Nombre de la Carrera <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ej. Ingeniería en Sistemas Computacionales" required
                                class="w-full rounded-lg border-[1.5px] bg-transparent py-3 px-5 font-medium outline-none transition disabled:cursor-default disabled:bg-whiter dark:bg-gray-700
                                {{ $errors->has('nombre') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-indigo-600 dark:border-gray-600 dark:text-white' }}" />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2 text-red-500" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-4.5 mt-8">
                        <a href="{{ route('admin.carreras.index') }}" class="flex justify-center rounded-lg border border-gray-300 py-2 px-6 font-medium text-gray-700 hover:shadow-sm dark:border-gray-600 dark:text-gray-300 dark:hover:text-white transition">
                            Cancelar
                        </a>
                        <button type="submit" class="flex justify-center rounded-lg bg-indigo-600 py-2 px-6 font-medium text-white hover:bg-opacity-90 hover:bg-indigo-700 transition shadow-md">
                            Guardar Carrera
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>