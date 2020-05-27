<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ServicioRoles;

class RolesController extends Controller
{
    protected $servicio_roles;

    public function __construct()
    {
        $this->servicio_roles = new ServicioRoles();
    }

    public function index()
    {
        return $this->servicio_roles->getAll();
    }
}
