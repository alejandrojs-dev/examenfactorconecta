<?php

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            [
                'nombre' => 'Admin'
            ],
            [
                'nombre' => 'Operador'
            ],
            [
                'nombre' => 'Administrativo'
            ]
        );

        foreach($roles as $rol)
        {
            Rol::create($rol);
        }
    }
}
