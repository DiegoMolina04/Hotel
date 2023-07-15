<?php

namespace Database\Seeders;

use App\Models\paises;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class paisesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Cargar el archivo csv en modo de solo lectura y luego guardarlo en una variable
        $csvPaises=fopen(base_path("database/data/paises.csv"),"r");

        /*
            Mientras el proceso de guardado de cada uno de los regitros del archivo csv sea exitoso, realizara n acciones.

            Cada registro no puede tener mas de n caracteres, y cada uno de los elementos separados por n caracter, seran guardados en forma de arreglo asociativo
        */
        while(($registro=fgetcsv($csvPaises,2000,";"))!=FALSE){ 

            //Buscar y elimanar algun caracterer especial en el valor que ocupara la columna id
            $registro[0]=str_replace("﻿","",$registro[0]);
                
            //Durante cada ejecucion los valores de cada registro se guardaran en forma de arreglo asociativo, por lo cual podemos crear dinamicamente los registros
            paises::create([
                'id'=>$registro[0],
                'nombre'=>$registro[1],
            ]);
        }
    }
}
