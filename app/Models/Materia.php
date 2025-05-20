<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'profesor_id','cupo_maximo'];
    public function estudiantes(){
        return $this->belongsToMany(User::class, 'estudiante_materia', 'materia_id', 'user_id')
                ->where('role', 'estudiante');
   
        // return $this->belongsToMany(User::class, 'estudiante_materia', 'materia_id', 'estudiante_id' ,'cupo_maximo');
    }
    public function profesor(){
        return $this->belongsTo(User::class, 'profesor_id');
    }
    //
}
