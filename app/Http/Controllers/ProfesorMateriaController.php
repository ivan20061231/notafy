<?php

namespace App\Http\Controllers;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProfesorMateriaController extends Controller
{
    public function index()
{
    $materias = Materia::where('profesor_id', auth()->id())->withCount('estudiantes')->get();
    return view('profesor.materias.index', compact('materias'));
}

public function create()
{
    return view('profesor.materias.create');
}

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'cupo_maximo' => 'required|integer|min:1',
    ]);

    Materia::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'cupo_maximo' => $request->cupo_maximo,
        'profesor_id' => auth()->id(),
    ]);

    return redirect()->route('profesor.materias.index')->with('success', 'Materia registrada');
}

public function estudiantes(Materia $materia)
{
    $this->authorize('view', $materia); // asegura que el profesor solo vea sus materias

    $estudiantes = $materia->estudiantes;

    return view('profesor.materias.estudiantes', compact('materia', 'estudiantes'));
}

public function guardarNotas(Request $request, Materia $materia, User $estudiante)
{
    $this->authorize('update', $materia);

    $request->validate([
        'nota1' => 'required|numeric|min:0|max:5',
        'nota2' => 'required|numeric|min:0|max:5',
    ]);

    $nota1 = $request->nota1;
    $nota2 = $request->nota2;
    $definitiva = ($nota1 + $nota2) / 2;

    $materia->estudiantes()->updateExistingPivot($estudiante->id, [
        'nota1' => $nota1,
        'nota2' => $nota2,
        'definitiva' => $definitiva,
    ]);

    return back()->with('success', 'Notas actualizadas');
}
public function notas($materiaId)
{
    $materia = Materia::with('estudiantes')->findOrFail($materiaId);

    // Verificamos que el profesor sea el dueño de la materia
    if ($materia->profesor_id !== auth()->id()) {
        abort(403);
    }

    return view('profesor.materias.notas', compact('materia'));
}
public function actualizarNotas(Request $request, $materiaId)
{
   $materia = Materia::with('estudiantes')->findOrFail($materiaId);

    if ($materia->profesor_id !== auth()->id()) {
        abort(403);
    }

    foreach ($request->notas as $estudianteId => $datosNota) {
        $user = User::find($estudianteId);

        if (!$user || $user->role !== 'estudiante') {
            continue;
        }

        $nota1 = $datosNota['corte1'] ?? null;
        $nota2 = $datosNota['corte2'] ?? null;
        $definitiva = (is_numeric($nota1) && is_numeric($nota2)) ? ($nota1 + $nota2) / 2 : null;

        $materia->estudiantes()->updateExistingPivot($estudianteId, [
            'nota_corte1' => $nota1,
            'nota_corte2' => $nota2,
            'nota_definitiva' => $definitiva,
        ]);
    }

    return redirect()->route('profesor.materias.index')->with('success', 'Notas actualizadas correctamente.');

}


}
