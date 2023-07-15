<?php

namespace Database\Seeders;

use App\Models\salones;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class salonesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
            Nota: Para agregar salones, solo deber añadir registros a este arreglo, todo esto manteniendo siempre los mismo nombres de claves
        */
        $info_salones=[
            [
                'id_tip_salon'=>1,
                'cantidad'=>10
            ],

            [
                'id_tip_salon'=>2,
                'cantidad'=>10
            ],
            [
                'id_tip_salon'=>3,
                'cantidad'=>10
            ]
        ];

        //Ciclo encargado de generar los registros de los salones de forma dinamica, de acuerdo a la informacion suministrada en el arreglo anterior
        foreach($info_salones as $info_salon){

            $centena=$info_salon['id_tip_salon']*100;

            for(
                $codigo=$centena;
                $codigo<(
                    $centena+$info_salon['cantidad']
                );
                $codigo++
            ){
                salones::create([
                    'id_tip_salon'=>$info_salon['id_tip_salon'],
                    'codigo'=>$codigo
                ]);
            }

        }

    }
}
