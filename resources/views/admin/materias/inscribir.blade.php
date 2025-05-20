<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Inscribir Estudiante a: {{ $materia->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-sm sm:rounded-lg p-6 text-white">
                @if(session('error'))
                    <div class="text-red-400 mb-4">{{ session('error') }}</div>
                @endif
                <form action="{{ route('admin.materias.inscribir', $materia) }}" method="POST">
                    @csrf
                    <label for="estudiante_id" class="block mb-2">Selecciona un estudiante:</label>
                    <select name="estudiante_id" id="estudiante_id" class="w-full text-black p-2 rounded mb-4" required>
                        <option value="">-- Selecciona --</option>
                        @foreach($estudiantes as $estudiante)
                            <option value="{{ $estudiante->id }}">{{ $estudiante->name }} ({{ $estudiante->email }})</option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Inscribir</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
