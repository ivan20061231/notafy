<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Dashboard de Profesor') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Tarjeta Materias Asignadas -->
            <div class="bg-gray-800 text-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold">Materias Asignadas</h3>
                <p class="text-3xl mt-2 font-bold text-blue-400">
                    {{ $totalMaterias}}
                </p>
            </div>

            <!-- Tarjeta Total Estudiantes -->
            <div class="bg-gray-800 text-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold">Estudiantes en tus Materias</h3>
                <p class="text-3xl mt-2 font-bold text-green-400">
                    {{ $totalEstudiantes}}
                </p>
            </div>

            <!-- Tarjeta Accesos rápidos -->
            <div class="bg-gray-800 text-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold">Accesos rápidos</h3>
                <div class="mt-3 space-y-2">
                    <a href="{{ route('profesor.materias.index') }}" class="block text-blue-400 hover:underline">Mis Materias</a>
                   
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
