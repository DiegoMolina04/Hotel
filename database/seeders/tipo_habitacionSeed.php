<?php

namespace Database\Seeders;

use App\Models\tipo_habitacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tipo_habitacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Registro: Individual
        $registro=new tipo_habitacion;
        $registro->nombre="Individual";
        $registro->max_personas=1;
        $registro->costo_base=(200000);
        $registro->save();

        //Registro: Doble
        $registro=new tipo_habitacion;
        $registro->nombre="Doble";
        $registro->max_personas=2;
        $registro->costo_base=(250000);
        $registro->save();

        //Registro: Doble Twing
        $registro=new tipo_habitacion;
        $registro->nombre="Doble Twing";
        $registro->max_personas=2;
        $registro->costo_base=(280000);
        $registro->save();

        //Registro: Empresarial
        $registro=new tipo_habitacion;
        $registro->nombre="Empresarial";
        $registro->max_personas=1;
        $registro->costo_base=(300000);
        $registro->save();

        //Registro: Matrimonial
        $registro=new tipo_habitacion;
        $registro->nombre="Matrimonial";
        $registro->max_personas=3;
        $registro->costo_base=(300000);
        $registro->save();

        //Registro: Suite
        $registro=new tipo_habitacion;
        $registro->nombre="Suite";
        $registro->max_personas=2;
        $registro->costo_base=(1000000);
        $registro->save();

    }
}
