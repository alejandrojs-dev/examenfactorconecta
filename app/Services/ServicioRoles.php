<?php
namespace App\Services;
use App\Models\Rol;
use App\Http\Resources\RolesCollection;
use Exception;

class ServicioRoles
{
    public function getAll()
    {
        try
        {
            return response()->json([
                'ok' => true,
                'roles' => new RolesCollection(Rol::all()),
                'code' => 200
            ], 200);

        }
        catch(Exception $e)
        {
            return response()->json([
                'ok' => false,
                'message' => 'Error al obtener la lista de roles',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
