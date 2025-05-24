<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Matricular Materia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensajes flash --}}
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

            {{-- Materias disponibles --}}
            <div class="bg-gray-800 text-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold mb-4">Materias Disponibles</h3>
                @if($materiasDisponibles->isEmpty())
                    <p class="text-gray-300">No hay materias disponibles para matricular.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach ($materiasDisponibles as $materia)
                            <div class="bg-gray-700 p-4 rounded-lg shadow flex flex-col justify-between">
                                <div>
                                    <h4 class="text-xl font-bold">{{ $materia->nombre }}</h4>
                                    <p class="text-sm text-gray-300 mt-1"><strong>Profesor:</strong> {{ $materia->profesor->name ?? 'No asignado' }}</p>
                                    <p class="text-sm text-gray-300"><strong>Cupos:</strong> {{ $materia->estudiantes_count }} / {{ $materia->cupo_maximo }}</p>
                                </div>
                                <form action="{{ route('estudiante.matricular.store', $materia->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                        Matricular
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Materias ya matriculadas --}}
           

        </div>
    </div>
</x-app-layout>
