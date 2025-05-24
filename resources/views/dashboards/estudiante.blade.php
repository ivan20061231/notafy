<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Mis Materias') }}
        </h2>
    </x-slot>
@if(session('success'))
                <div class="mb-4 bg-green-700 text-white px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-700 text-white px-4 py-2 rounded">
                    {{ session('error') }}
                </div>
            @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('estudiante.matricular') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                    Matricular Nueva Materia
                </a>

                @if(session('success'))
                    <div class="mb-4 bg-green-700 text-green-100 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($materiasMatriculadas->isEmpty())
                    <p class="text-gray-300">No estás matriculado en ninguna materia.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-700 text-white">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Profesor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">1er Corte</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">2do Corte</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Definitiva</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-600">
                            @foreach ($materiasMatriculadas as $materia)
                                <tr>
                                    <td class="px-6 py-4">{{ $materia->nombre }}</td>
                                    <td class="px-6 py-4">{{ $materia->profesor->name ?? 'No asignado' }}</td>
                                    <td class="px-6 py-4">
                                        {{ $materia->pivot->nota_corte1 ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $materia->pivot->nota_corte2 ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                       
                                        {{ $materia-> pivot->nota_definitiva ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('estudiante.matricular.cancelar', $materia->id) }}" method="POST" onsubmit="return confirm('¿Deseas cancelar esta materia?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:underline">
                                                Cancelar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
