<?php

namespace Database\Seeders;

use App\Models\tipo_pqrs as ModelsTipo_pqrs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tipo_pqrsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Importar el modelo a partir de una clase transportadora
        $registro=new ModelsTipo_pqrs;

        //Registro: Peticion
        $registro->nombre="Peticion";
        $registro->save();

        //Registro: Queja
        $registro=new ModelsTipo_pqrs();
        $registro->nombre="Queja";
        $registro->save();

        //Registro: Reclamo
        $registro=new ModelsTipo_pqrs();
        $registro->nombre="Reclamo";
        $registro->save();

        //Registro: Sugerencias
        $registro=new ModelsTipo_pqrs();
        $registro->nombre="Sugerencia";
        $registro->save();
    }
}
