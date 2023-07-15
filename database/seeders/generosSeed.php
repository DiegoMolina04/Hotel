<?php

namespace Database\Seeders;

use App\Models\generos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class generosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Instanciamiento del modelo en una variable transportadora
        $registro=new generos;

        //Registro: Genero femenino
        $registro->nombre="Femenino";
        $registro->save();

        //Registro: Genero masculino
        $registro=new generos;
        $registro->nombre="Masculino";
        $registro->save();

        //Registro: Genero No binario
        $registro=new generos;
        $registro->nombre="No binario";
        $registro->save();

    }
}
