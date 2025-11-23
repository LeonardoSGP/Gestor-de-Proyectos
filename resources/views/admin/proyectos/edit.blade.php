<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Editar Proyecto') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                <form action="{{ route('admin.proyectos.update', $proyecto) }}" method="POST">
                    @csrf @method('PUT')
                    
                    <div class="mb-4">
                        <x-input-label for="nombre" value="Nombre del Proyecto" />
                        <x-text-input id="nombre" name="nombre" class="w-full mt-1" value="{{ old('nombre', $proyecto->nombre) }}" required />
                    </div>
                    
                    <div class="mb-4">
                        <x-input-label for="descripcion" value="Descripción" />
                        <textarea name="descripcion" class="w-full mt-1 border-gray-300 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300 rounded-md shadow-sm">{{ old('descripcion', $proyecto->descripcion) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="repositorio_url" value="URL Repositorio" />
                        <x-text-input id="repositorio_url" name="repositorio_url" class="w-full mt-1" value="{{ old('repositorio_url', $proyecto->repositorio_url) }}" />
                    </div>

                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('admin.proyectos.show', $proyecto) }}" class="text-gray-600 dark:text-gray-400 underline hover:text-gray-900 dark:hover:text-gray-100">Cancelar</a>
                        <x-primary-button>Actualizar</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>