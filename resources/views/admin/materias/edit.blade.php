<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Editar Materia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">
                <form action="{{ route('admin.materias.update', $materia) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nombre" class="block font-medium mb-1">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $materia->nombre) }}" required
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white">
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block font-medium mb-1">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="3" required
                                  class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white">{{ old('descripcion', $materia->descripcion) }}</textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
                    <a href="{{ route('admin.materias.index') }}" class="ml-4 text-gray-300 hover:underline">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
