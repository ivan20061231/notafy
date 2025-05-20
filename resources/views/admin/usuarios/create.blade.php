<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-6 rounded shadow text-white">
                <form action="{{ route('admin.usuarios.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm">Nombre</label>
                        <input type="text" name="name" class="w-full p-2 rounded bg-gray-700 text-white" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm">Email</label>
                        <input type="email" name="email" class="w-full p-2 rounded bg-gray-700 text-white" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm">Contraseña</label>
                        <input type="password" name="password" class="w-full p-2 rounded bg-gray-700 text-white" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="w-full p-2 rounded bg-gray-700 text-white" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm">Rol</label>
                        <select name="role" class="w-full p-2 rounded bg-gray-700 text-white" required>
                            <option value="admin">Admin</option>
                            <option value="profesor">Profesor</option>
                            <option value="estudiante">Estudiante</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-green-500 px-4 py-2 rounded">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>