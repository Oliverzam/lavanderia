<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Operaciones sobre tabla roles

            //Operacions sobre tabla blogs
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

            'ver-audit'
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
