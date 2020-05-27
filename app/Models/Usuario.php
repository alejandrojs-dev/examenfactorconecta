<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nick',
        'nombre',
        'apellidos',
        'correo',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    //Relaciones
    public function roles()
    {
        return $this->belongsToMany('App\Models\Rol', 'rol_usuario', 'usuario_id');
    }
}
