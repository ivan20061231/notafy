<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function dashboard()
    {
        return view('dashboards.profesor'); // Asegúrate de tener esta vista también
    }
}
