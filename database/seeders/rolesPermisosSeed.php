<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class rolesPermisosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Arreglo contenedor de la informacion de los roles a crear junto con sus respectivos permisos
        $roles=[
            [
                'nombre_rol'=>'cliente',
                'permisos'=>[]
            ],
            [
                'nombre_rol'=>'recepcionista',
                'permisos'=>[]
            ],
            [
                'nombre_rol'=>'servicio_cliente',
                'permisos'=>[]
            ],
            [
                'nombre_rol'=>'coordinador_inventario',
                'permisos'=>[]
            ],
            [
                'nombre_rol'=>'personal_aseo',
                'permisos'=>[]
            ],
            [
                'nombre_rol'=>'coordinador_eventos',
                'permisos'=>[]
            ]
        ];

        foreach($roles as $rol){

            //Creacion del Rol
            $registro_rol=Role::create(['name'=>$rol['nombre_rol']]);
            
            //Busqueda o creacion del permiso y su posterior asociacion con el rol creado
            foreach($rol['permisos'] as $permiso){
                $registro_permiso=Permission::findOrCreate($permiso);

                $registro_rol->givePermissionTo($registro_permiso);
            }

        }

    }
}
