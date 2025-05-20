<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
         $materias = Materia::with('profesor')->withCount(['estudiantes'])->get();
            return view('admin.materias.index', compact('materias'));
        //$materias = Materia::with('profesor')->get();
        //return view('admin.materias.index', compact('materias'));
    }

    public function create()
    {
        $profesores = User::where('role', 'profesor')->get();
        return view('admin.materias.create', compact('profesores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'profesor_id' => 'required|exists:users,id',
            'cupo_maximo' => 'required|integer|min:1',
        ]);

        Materia::create($request->all());

        return redirect()->route('admin.materias.index')->with('success', 'Materia creada correctamente');
    }

    public function edit(Materia $materia)
    {
        $profesores = User::where('role', 'profesor')->get();
        return view('admin.materias.edit', compact('materia', 'profesores'));
    }

    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            //'profesor_id' => 'required|exists:users,id',
        ]);

        $materia->update($request->all());

        return redirect()->route('admin.materias.index')->with('success', 'Materia actualizada correctamente');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('admin.materias.index')->with('success', 'Materia eliminada');
    }
    public function inscribirForm(Materia $materia)
    {
    $estudiantes = User::where('role', 'estudiante')->get();
    return view('admin.materias.inscribir', compact('materia', 'estudiantes'));
    }

    public function inscribir(Request $request, Materia $materia)
    {
    $request->validate([
        'estudiante_id' => 'required|exists:users,id',
    ]);

    // Verifica que no esté ya inscrito
    if ($materia->estudiantes()->where('user_id', $request->estudiante_id)->exists()) {
        return back()->with('error', 'El estudiante ya está inscrito en esta materia.');
    }

    // Verifica cupo
    if ($materia->estudiantes()->count() >= $materia->cupo_maximo) {
        return back()->with('error', 'La materia ha alcanzado el cupo máximo.');
    }

    // Inscribe
    $materia->estudiantes()->attach($request->estudiante_id);

    return redirect()->route('admin.materias.index')->with('success', 'Estudiante inscrito exitosamente.');
    }
    public function verEstudiantes(Materia $materia)
{
    $estudiantes = $materia->estudiantes;
    $usuariosEstudiantes = User::where('role', 'estudiante')
        ->whereNotIn('id', $estudiantes->pluck('id'))
        ->get();

    return view('admin.materias.estudiantes', compact('materia', 'estudiantes', 'usuariosEstudiantes'));
}

public function inscribirEstudiante(Request $request, Materia $materia)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    if ($materia->estudiantes()->where('user_id', $request->user_id)->exists()) {
        return back()->with('error', 'El estudiante ya está inscrito.');
    }

    if ($materia->estudiantes()->count() >= $materia->cupo_maximo) {
        return back()->with('error', 'La materia alcanzó el cupo máximo.');
    }

    $materia->estudiantes()->attach($request->user_id);
    return back()->with('success', 'Estudiante inscrito correctamente.');
}

public function eliminarEstudiante(Materia $materia, User $user)
{
    $materia->estudiantes()->detach($user->id);
    return back()->with('success', 'Estudiante eliminado de la materia.');
}


}
