<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Estudiantes en {{ $materia->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Mensajes de sesión --}}
            @if(session('success'))
                <div class="bg-green-600 text-white px-4 py-2 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-600 text-white px-4 py-2 rounded shadow">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Lista de estudiantes inscritos --}}
            <div class="bg-gray-800 shadow sm:rounded-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-4">Estudiantes inscritos</h3>
                <table class="min-w-full divide-y divide-gray-700 text-white">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs uppercase tracking-wider">Nombre</th>
                            <th class="px-4 py-2 text-left text-xs uppercase tracking-wider">Email</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($estudiantes as $estudiante)
                            <tr>
                                <td class="px-4 py-2">{{ $estudiante->name }}</td>
                                <td class="px-4 py-2">{{ $estudiante->email }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('admin.materias.eliminarEstudiante', [$materia, $estudiante]) }}" method="POST" onsubmit="return confirm('¿Eliminar estudiante?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-gray-400">No hay estudiantes inscritos.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Formulario para inscribir estudiante --}}
            <div class="bg-gray-800 shadow sm:rounded-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-4">Inscribir nuevo estudiante</h3>
                <form method="POST" action="{{ route('admin.materias.inscribirEstudiante', $materia) }}">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4">
                        <select name="user_id" class="bg-gray-900 border border-gray-600 rounded px-3 py-2 w-full text-white" required>
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
    </div>
</x-app-layout>
