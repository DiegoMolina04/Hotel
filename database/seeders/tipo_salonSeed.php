<?php

namespace Database\Seeders;

use App\Models\tipo_salon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tipo_salonSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Nota: Para agregar un tipo de salon, unicamente se debe, añadir dentro de este arreglo, siguiendo su estructura
        $tipos_salon=[
            [
                'nombre'=>"Paradise",
                'max_personas'=>100,
                'precio_base'=>"200000",
                'precio_silla'=>"2000"
            ],

            [
                'nombre'=>"Marvelous",
                'max_personas'=>150,
                'precio_base'=>"300000",
                'precio_silla'=>"3000"
            ],

            [
                'nombre'=>"Freedom",
                'max_personas'=>200,
                'precio_base'=>"400000",
                'precio_silla'=>"3500"
            ]
        ];

        //Clico encargado de guardar los registros que se encuentran en el arreglo anterior
        foreach($tipos_salon as $tipo_salon){
            $registro=new tipo_salon();

            $registro->nombre=$tipo_salon['nombre'];
            $registro->max_personas=$tipo_salon['max_personas'];
            $registro->precio_base=$tipo_salon['precio_base'];
            $registro->precio_silla=$tipo_salon['precio_silla'];

            $registro->save();
        }
    }
}
