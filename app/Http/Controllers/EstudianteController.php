<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function dashboard()
    {
        $estudiante = auth()->user();
        $materiasInscritas = $estudiante->materias;
        return view('dashboards.estudiante', compact('materiasInscritas'));
    }

    public function matricular(Materia $materia)
    {
        $estudiante = auth()->user();
        if ($estudiante->materias->contains($materia)) {
            return back()->withErrors('Ya estás matriculado en esta materia.');
        }

        if ($materia->cupo_maximo <= $materia->estudiantes->count()) {
            return back()->withErrors('No hay cupos disponibles.');
        }

        $estudiante->materias()->attach($materia);
        return back()->with('success', '¡Matriculado exitosamente!');
    }
}
