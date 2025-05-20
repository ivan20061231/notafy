<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('admin.usuarios.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Crear Usuario</a>
                <table class="min-w-full divide-y divide-gray-700 text-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Rol</th>
                            <th class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td class="px-6 py-4">{{ $usuario->name }}</td>
                            <td class="px-6 py-4">{{ $usuario->email }}</td>
                            <td class="px-6 py-4">{{ $usuario->role }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="text-blue-400 hover:underline">Editar</a>
                                <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline ml-2">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>