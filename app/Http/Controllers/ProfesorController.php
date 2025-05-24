<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class ProfesorController extends Controller
{
public function dashboard()
{
    $profesor = auth()->user();
    $materias = $profesor->materiasDictadas()->with('estudiantes')->get();
    $totalMaterias = $materias->count();
    $totalEstudiantes = $materias->sum(function ($materia) {
        return $materia->estudiantes->count();
    });

    return view('dashboards.profesor', compact('materias', 'totalMaterias', 'totalEstudiantes'));
}


}
