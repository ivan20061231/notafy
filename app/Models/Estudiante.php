<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Estudiante extends Model
{
     use HasFactory;

    // Indicar la tabla que se usará en la base de datos
    protected $table = 'estudiantes'; // Solo si el nombre de la tabla no sigue la convención plural

    // Los atributos que pueden ser asignados en masa
    protected $fillable = [
        'nombre', 
        'email', 
        'password'
    ];

    // Relación con las materias (muchos a muchos)
    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'estudiante_materia', 'estudiante_id', 'materia_id');
    }
    //
}
