<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido al Sistema de Notas</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-slate-900 text-white flex items-center justify-center min-h-screen">
    <header class="absolute top-0 left-0 p-6">
        @include('components.logo')
    </header>
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-10">Bienvenido al Sistema de Notas</h1>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-5xl mx-auto px-4">
            {{-- Estudiante --}}
            <a href="{{ route('login', ['role' => 'estudiante']) }}"
               class="bg-blue-600 hover:bg-blue-700 rounded-2xl p-8 shadow-lg flex flex-col items-center transition transform hover:scale-105">
                <i class="ph ph-graduation-cap text-black text-6xl mb-4"></i>
                <span class="text-xl font-semibold">Estudiante</span>
            </a>

            {{-- Profesor --}}
            <a href="{{ route('login', ['role' => 'profesor']) }}"
               class="bg-green-600 hover:bg-green-700 rounded-2xl p-8 shadow-lg flex flex-col items-center transition transform hover:scale-105">
                <i class="ph ph-chalkboard-teacher text-white text-6xl mb-4"></i>
                <span class="text-xl font-semibold">Profesor</span>
            </a>

            {{-- Admin --}}
            <a href="{{ route('login', ['role' => 'admin']) }}"
               class="bg-purple-600 hover:bg-purple-700 rounded-2xl p-8 shadow-lg flex flex-col items-center transition transform hover:scale-105">
                <i class="ph ph-shield-check text-white text-6xl mb-4"></i>
                <span class="text-xl font-semibold">Administrador</span>
            </a>
        </div>
    </div>

</body>
</html>
