<?php
use App\Http;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfileController;

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Vista de bienvenida
Route::get('/', fn() => view('welcome'));

// Redirección después de login

Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'profesor' => redirect()->route('profesor.dashboard'),
        'estudiante' => redirect()->route('estudiante.dashboard'),
        default => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas con middleware por rol
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('usuarios', App\Http\Controllers\Admin\UserController::class);
    Route::resource('materias', MateriaController::class);
    Route::get('/materias/{materia}/estudiantes', [MateriaController::class, 'verEstudiantes'])->name('materias.estudiantes');
    Route::post('/materias/{materia}/estudiantes', [MateriaController::class, 'inscribirEstudiante'])->name('materias.inscribirEstudiante');
    Route::delete('/materias/{materia}/estudiantes/{user}', [MateriaController::class, 'eliminarEstudiante'])->name('materias.eliminarEstudiante');

    Route::get('materias/{materia}/estudiantes/inscribir', [MateriaController::class, 'inscribirForm'])->name('materias.inscribir.form');
    Route::post('materias/{materia}/estudiantes/inscribir', [MateriaController::class, 'inscribir'])->name('materias.inscribir');

});

Route::middleware(['auth', 'role:profesor'])->prefix('profesor')->name('profesor.')->group(function () {
    Route::get('/dashboard', [ProfesorController::class, 'dashboard'])->name('dashboard');
});

Route::middleware(['auth', 'role:estudiante'])->prefix('estudiante')->name('estudiante.')->group(function () {
    Route::get('/dashboard', [EstudianteController::class, 'dashboard'])->name('dashboard');
    Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
    Route::post('/materias/{materia}/matricular', [EstudianteController::class, 'matricular'])->name('materias.matricular');
});



// Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación
require __DIR__.'/auth.php';
