<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Estudiantes en {{ $materia->nombre }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
        @endif

        <div class="bg-white shadow sm:rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Estudiantes inscritos</h3>
            <ul>
                @forelse($estudiantes as $estudiante)
                    <li class="flex justify-between border-b py-2">
                        <span>{{ $estudiante->name }} ({{ $estudiante->email }})</span>
                        <form action="{{ route('admin.materias.eliminarEstudiante', [$materia, $estudiante]) }}" method="POST" onsubmit="return confirm('¿Eliminar estudiante?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </li>
                @empty
                    <li>No hay estudiantes inscritos.</li>
                @endforelse
            </ul>
        </div>

        <div class="bg-white shadow sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Inscribir nuevo estudiante</h3>
            <form method="POST" action="{{ route('admin.materias.estudiantes.inscribir', $materia) }}">
                @csrf
                <div class="flex gap-4">
                    <select name="user_id" class="border rounded px-3 py-2 w-full" required>
                        <option value="">Seleccione un estudiante</option>
                        @foreach($usuariosEstudiantes as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }} ({{ $usuario->email }})</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Inscribir</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
