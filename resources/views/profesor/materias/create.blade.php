<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Registrar Materia
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <div class="bg-gray-800 p-6 rounded-lg shadow text-white">
            <form method="POST" action="{{ route('profesor.materias.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Nombre</label>
                    <input type="text" name="nombre" class="w-full px-3 py-2 rounded text-black" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Descripción</label>
                    <textarea name="descripcion" class="w-full px-3 py-2 rounded text-black"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Cupo Máximo</label>
                    <input type="number" name="cupo_maximo" class="w-full px-3 py-2 rounded text-black" required min="1">
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
            </form>
        </div>
    </div>
</x-app-layout>
