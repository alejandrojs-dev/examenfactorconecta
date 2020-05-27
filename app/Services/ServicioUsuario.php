<?php
namespace App\Services;
use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use App\Http\Resources\Usuario as UsuarioResource;
use App\Http\Resources\UsuariosCollection;
use Exception;
use Crypt;

class ServicioUsuario
{
    public function getAll()
    {
        try
        {
            $roles = Usuario::with('roles')->paginate(10);
            return response()->json([
                'ok' => true,
                'pagination' => [
                    'total' => $roles->total(),
                    'current_page' => $roles->currentPage(),
                    'per_page' => $roles->perPage(),
                    'last_page' => $roles->lastPage(),
                    'from' => $roles->firstItem(),
                    'to' => $roles->lastPage()
                ],
                'usuarios' => new UsuariosCollection($roles),
                'code' => 200
            ], 200);

        }
        catch(Exception $e)
        {
            return response()->json([
                'ok' => false,
                'message' => 'Error al obtener la lista de usuarios',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function get(Usuario $usuario)
    {
        try
        {
            return response()->json([
                'ok' => true,
                'usuario' => new UsuarioResource($usuario),
                'code' => 200
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'ok' => false,
                'message' => 'Error al obtener al usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function save(UsuarioRequest $request)
    {
        try
        {
            $usuario = new Usuario();
            $usuario->nick = $request->nick;
            $usuario->nombre = $request->nombre;
            $usuario->apellidos = $request->apellidos;
            $usuario->password = encrypt($request->password);
            $usuario->correo = $request->correo;
            $usuario->save();

            $usuario->roles()->attach($request->rol_id);

            return response()->json([
                'ok' => true,
                'usuario' => new UsuarioResource($usuario),
                'message' => 'Usuario creado con éxito',
                'code' => 201
            ], 201);
        }
        catch(Exception $e)
        {
            return response()->json([
                'ok' => false,
                'message' => 'Error al crear al usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        try {

            $usuario->nick = $request->nick;
            $usuario->nombre = $request->nombre;
            $usuario->apellidos = $request->apellidos;
            $usuario->password = encrypt($request->password);
            $usuario->correo = $request->correo;
            $usuario->save();

            $usuario->roles()->sync([$request->rol_id]);

            return response()->json([
                'ok' => true,
                'usuario' => new UsuarioResource($usuario),
                'message' => 'Usuario actualizado con éxito'
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'ok' => false,
                'message' => 'Error al actualizar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Usuario $usuario)
    {
        try
        {
            $usuario->delete();

            return response()->json([
                'ok' => true,
                'message' => 'Usuario eliminado con éxito',
                'code' => 200
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'ok' => false,
                'message' => 'Error al eliminar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
