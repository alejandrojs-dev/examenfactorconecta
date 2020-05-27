<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Usuario extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'nick'          => $this->nick,
            'nombre'        => $this->nombre,
            'password'      => decrypt($this->password),
            'apellidos'     => $this->apellidos,
            'correo'        => $this->correo,
            'roles'         => $this->roles
        ];
    }
}
