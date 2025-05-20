<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-6 rounded shadow text-white">
                <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm">Nombre</label>
                        <input type="text" name="name" class="w-full p-2 rounded bg-gray-700 text-white" value="{{ $usuario->name }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm">Email</label>
                        <input type="email" name="email" class="w-full p-2 rounded bg-gray-700 text-white" value="{{ $usuario->email }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm">Rol</label>
                        <select name="role" class="w-full p-2 rounded bg-gray-700 text-white">
                            <option value="admin" @selected($usuario->role == 'admin')>Admin</option>
                            <option value="profesor" @selected($usuario->role == 'profesor')>Profesor</option>
                            <option value="estudiante" @selected($usuario->role == 'estudiante')>Estudiante</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-yellow-500 px-4 py-2 rounded">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
