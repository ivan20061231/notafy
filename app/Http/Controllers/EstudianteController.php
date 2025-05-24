<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Materia;
use App\Models\Estudiante;

use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function dashboard()
    {
        $estudiante = auth()->user();
        $materiasInscritas = $estudiante->materias;
         $materias = $estudiante->materias()->with('profesor')->get();
          $materiasMatriculadas = $estudiante->materias;
        return view('dashboards.estudiante', compact('materiasInscritas','materias','materiasMatriculadas','estudiante'));
    }

   
    public function verMateriasDisponibles()

        {
           $estudiante = Auth::user();

    $materiasYaInscrito = $estudiante->materias()->pluck('materia_id');

    $materiasDisponibles = Materia::whereNotIn('id', $materiasYaInscrito)
        ->withCount('estudiantes')
        ->get()
        ->filter(function ($materia) {
            return $materia->estudiantes_count < $materia->cupo_maximo;
        });

    $materiasMatriculadas = $estudiante->materias;

    return view('estudiante.matricular', compact('materiasDisponibles', 'materiasMatriculadas'));
        }


    public function matricular($id)
        {
            $estudiante = Auth::user();

            $materia = Materia::withCount('estudiantes')->findOrFail($id);

            if ($materia->estudiantes_count >= $materia->cupo_maximo) {
                return back()->with('error', 'No hay cupos disponibles');
            }

            if ($estudiante->materias()->where('materia_id', $id)->exists()) {
                return back()->with('error', 'Ya estás inscrito en esta materia');
            }

            $estudiante->materias()->attach($id);
            return redirect()->route('estudiante.dashboard')->with('success', 'Materia matriculada con éxito');
        }
        public function cancelarMatricula($id)
{
    $estudiante = Auth::user();

    // Desvinculamos la materia del estudiante (asumiendo relación many-to-many)
    $estudiante->materias()->detach($id);

    return redirect()->route('dashboard')->with('success', 'Materia cancelada correctamente.');
}

}
