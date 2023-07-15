<?php

namespace Database\Seeders;

use App\Models\tipo_documentos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tipo_documentosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Instanciamiento del modelo en una variable transportadora
        $registro=new tipo_documentos;

        //Registro: Cedula de Ciudadania
        $registro->prefijo="CC";
        $registro->nombre="Cedula de Ciudadania";
        $registro->save();

        //Registro: Pasaporte
        $registro=new tipo_documentos;
        $registro->prefijo="PA";
        $registro->nombre="Pasaporte";
        $registro->save();

        //Registro: Carnet Diplomatico
        $registro=new tipo_documentos;
        $registro->prefijo="CD";
        $registro->nombre="Carnet Diplomatico";
        $registro->save();

        //Registro: Cedula de Extranjeria
        $registro=new tipo_documentos;
        $registro->prefijo="CE";
        $registro->nombre="Cedula de Extranjeria";
        $registro->save();

        //Registro: Cedula de Extranjeria
        $registro=new tipo_documentos;
        $registro->prefijo="NI";
        $registro->nombre="Numero de Identificacion Tributaria";
        $registro->save();

    }
}
