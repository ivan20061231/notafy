<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Materias Asignadas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">
                <a href="{{ route('profesor.materias.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Registrar Materia</a>

                <table class="min-w-full divide-y divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Descripción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Cupo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        @foreach ($materias as $materia)
                            <tr>
                                <td class="px-6 py-4">{{ $materia->nombre }}</td>
                                <td class="px-6 py-4">{{ $materia->descripcion }}</td>
                                 <td class="px-6 py-4">{{ $materia->estudiantes_count }} / {{ $materia->cupo_maximo }}</td>
                                
                                <td class="px-6 py-4">
                                    <a href="{{ route('profesor.materias.notas', $materia) }}" class="text-green-400 hover:underline">Ver Notas</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
