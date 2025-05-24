<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Notas de los Estudiantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg text-white mb-4">{{ $materia->nombre }}</h3>

                <form action="{{ route('profesor.materias.notas.actualizar', $materia->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <table class="min-w-full divide-y divide-gray-700 text-white mb-6">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Estudiante</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Primer Corte</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Segundo Corte</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Definitiva</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-600">
                            @foreach ($materia->estudiantes as $estudiante)
                                <tr>
                                    <td class="px-6 py-4">{{ $estudiante->name }}</td>
                                    <td class="px-6 py-4">
                                        <input type="number" name="notas[{{ $estudiante->id }}][corte1]"
                                            value="{{ $estudiante->pivot->nota_corte1 }}"
                                            class="bg-gray-700 text-white rounded p-1 w-20" step="0.1" min="0" max="5">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="number" name="notas[{{ $estudiante->id }}][corte2]"
                                            value="{{ $estudiante->pivot->nota_corte2 }}"
                                            class="bg-gray-700 text-white rounded p-1 w-20" step="0.1" min="0" max="5">
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $n1 = $estudiante->pivot->nota_corte1;
                                            $n2 = $estudiante->pivot->nota_corte2;
                                            $def = is_numeric($n1) && is_numeric($n2) ? round(($n1 + $n2) / 2, 2) : 'N/A';
                                        @endphp
                                        {{ $def }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Guardar Notas
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
