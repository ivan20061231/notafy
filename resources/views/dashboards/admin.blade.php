<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Dashboard de Admin') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Tarjeta Total Usuarios -->
            <div class="bg-gray-800 text-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold">Total Profesores</h3>
                <p class="text-3xl mt-2 font-bold text-blue-400">{{ $totalProfesores }}</p>
            </div>

            <!-- Tarjeta Total Estudiantes -->
            <div class="bg-gray-800 text-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold">Total Estudiantes</h3>
                <p class="text-3xl mt-2 font-bold text-green-400">{{ $totalEstudiantes }}</p>
            </div>

            <!-- Tarjeta Total Materias -->
            <div class="bg-gray-800 text-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold">Total Materias</h3>
                <p class="text-3xl mt-2 font-bold text-purple-400">{{ $totalMaterias }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
