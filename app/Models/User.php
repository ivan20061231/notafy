<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function materias(){
    return $this->belongsToMany(Materia::class, 'estudiante_materia', 'user_id', 'materia_id')
    ->withPivot('nota_corte1', 'nota_corte2', 'nota_definitiva')
                ->withTimestamps();
    }

    public function materiasDictadas(){
    return $this->hasMany(Materia::class, 'profesor_id');
    }


    public function isAdmin() {
    return $this->role === 'admin';
    }

    public function isProfesor() {
    return $this->role === 'profesor';
    }   

    public function isEstudiante() {
    return $this->role === 'estudiante';
}
}
