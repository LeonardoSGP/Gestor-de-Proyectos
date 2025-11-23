<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('admin.equipos.store') }}">
                    @csrf

                    <div class="mb-6">
                        <x-input-label for="nombre" :value="__('Nombre del Equipo')" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus placeholder="Ej. Alpha Team" />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Al crear el equipo, serás redirigido para asignar a los miembros.</p>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.equipos.index') }}" class="text-gray-600 dark:text-gray-400 underline mr-4 text-sm hover:text-gray-900 dark:hover:text-gray-100">Cancelar</a>
                        <x-primary-button>
                            {{ __('Crear y Asignar Miembros') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>