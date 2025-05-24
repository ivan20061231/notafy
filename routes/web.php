<?php
use App\Http;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProfesorMateriaController;
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
     Route::get('/materias', [ProfesorMateriaController::class, 'index'])->name('materias.index');
    Route::get('/materias/create', [ProfesorMateriaController::class, 'create'])->name('materias.create');
    Route::post('/materias', [ProfesorMateriaController::class, 'store'])->name('materias.store');
    Route::get('/materias/{materia}/estudiantes', [ProfesorMateriaController::class, 'estudiantes'])->name('materias.estudiantes');
    Route::post('/materias/{materia}/estudiantes/{estudiante}/notas', [ProfesorMateriaController::class, 'guardarNotas'])->name('materias.notas.guardar');
    Route::get('/materias/{materia}/notas', [ProfesorMateriaController::class, 'notas'])
    ->name('materias.notas');

Route::put('/materias/{materia}/notas', [ProfesorMateriaController::class, 'actualizarNotas'])
    ->name('materias.notas.actualizar');
});

Route::middleware(['auth', 'role:estudiante'])->prefix('estudiante')->name('estudiante.')->group(function () {
    Route::get('/dashboard', [EstudianteController::class, 'dashboard'])->name('dashboard');
    Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
    Route::post('/materias/{materia}/matricular', [EstudianteController::class, 'matricular'])->name('materias.matricular');
    Route::get('/matricular', [EstudianteController::class, 'verMateriasDisponibles'])->name('matricular');
    Route::post('/matricular/{id}', [EstudianteController::class, 'matricular'])->name('matricular.store');

    Route::delete('/matricular/{id}/cancelar', [EstudianteController::class, 'cancelarMatricula'])->name('matricular.cancelar');

});



// Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación
require __DIR__.'/auth.php';
