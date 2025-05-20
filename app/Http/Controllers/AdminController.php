<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Materia;


class AdminController extends Controller
{
    public function dashboard()
{
    $totalProfesores = User::where('role', 'profesor')->count();
    $totalEstudiantes =  $totalEstudiantes = User::where('role', 'estudiante')->count();
    $totalMaterias = Materia::count();

    return view('dashboards.admin', compact('totalProfesores', 'totalEstudiantes', 'totalMaterias'));
}
}