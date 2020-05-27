<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';

    protected $fillable = ['nombre'];

    //Relaciones
    public function usuarios()
    {
        return $this->belongsToMany('App\Models\Usuario', 'rol_usuario', 'rol_id');
    }
}
