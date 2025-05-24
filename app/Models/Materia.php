<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'profesor_id','cupo_maximo'];
    public function estudiantes(){
        return $this->belongsToMany(User::class, 'estudiante_materia', 'materia_id', 'user_id')
        ->withPivot('nota_corte1', 'nota_corte2', 'nota_definitiva')
        ->where('role', 'estudiante');

   
        // return $this->belongsToMany(User::class, 'estudiante_materia', 'materia_id', 'estudiante_id' ,'cupo_maximo');
    }
    public function profesor(){
        return $this->belongsTo(User::class, 'profesor_id');
    }
    //
}
