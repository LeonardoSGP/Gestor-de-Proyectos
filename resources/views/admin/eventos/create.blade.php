<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Evento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('admin.eventos.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="nombre" :value="__('Nombre del Evento')" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="descripcion" :value="__('Descripción')" />
                        <textarea id="descripcion" name="descripcion" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('descripcion') }}</textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="fecha_inicio" :value="__('Fecha de Inicio')" />
                            <x-text-input id="fecha_inicio" class="block mt-1 w-full" type="datetime-local" name="fecha_inicio" :value="old('fecha_inicio')" required />
                            <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="fecha_fin" :value="__('Fecha de Fin')" />
                            <x-text-input id="fecha_fin" class="block mt-1 w-full" type="datetime-local" name="fecha_fin" :value="old('fecha_fin')" required />
                            <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.eventos.index') }}" class="text-gray-600 dark:text-gray-400 underline mr-4 hover:text-gray-900 dark:hover:text-gray-100">Cancelar</a>
                        <x-primary-button>
                            {{ __('Guardar Evento') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>