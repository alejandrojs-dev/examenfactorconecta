<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nick'      => 'required|unique:usuarios,nick|regex:/^[_a-zA-Z0-9]*$/',
            'nombre'    => 'required',
            'correo'    => 'required|email',
            'rol_id'    => 'required|exists:roles,id',
            'password'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nick.required'     => 'El nick del usuario debe ser obligatorio',
            'nick.unique'       => 'Ya existe un usuario registrado con ese nick',
            'nick.regex'        => 'El nick debe contener caracteres alfanúmericos y/o iniciar con guión bajo',
            'nombre.required'   => 'El nombre del usuario debe ser obligatorio',
            'correo.required'   => 'El correo es obligatorio',
            'correo.email'      => 'El correo debe tener un formato válido',
            'password.required' => 'La contraseña es obligatoria',
            'rol_id.required'   => 'El rol debe ser obligatorio',
            'rol_id.exists'     => 'El rol no existe en la base de datos'
        ];
    }
}
