<?php

namespace Database\Seeders;

use App\Models\estados_habitacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class estados_habitacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Arreglo contenedor de los estados que pueden tener las habitaciones
        $estados=['ocupada','libre','mantenimiento','clausurada'];

        //Guardado automatico de los estados
        foreach($estados as $estado){
            estados_habitacion::create([
                'nombre'=>$estado
            ]);
        }
    }
}
