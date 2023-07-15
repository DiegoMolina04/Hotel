<?php

namespace Database\Seeders;

use App\Models\tipo_evento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tipo_eventoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Nota: Para agregar un tipo de evento, unicamente se debe, añadir dentro de este arreglo, siguiendo su estructura
        $tipos_evento=[
            [
                'nombre'=>"Solo espacio",
                'detallado'=>"Detalles",
                'precio_general' => "0",
                'precio_invitado' => "0",
                'max_especiales' => 0,
                'min_especiales' => 0,
                'nom_especiales' => "NaN"
            ],
            [
                'nombre'=>"Boda - standard",
                'detallado'=>"Detalles",
                'precio_general' => "1000000",
                'precio_invitado' => "15000",
                'max_especiales' => 2,
                'min_especiales' => 2,
                'nom_especiales' => "Novios"
            ],
            [
                'nombre'=>"Boda - dreamy",
                'detallado'=>"Detalles",
                'precio_general' => "1500000",
                'precio_invitado' => "20000",
                'max_especiales' => 2,
                'min_especiales' => 2,
                'nom_especiales' => "Novios"
            ],
            [
                'nombre'=>"Boda - perfect",
                'detallado'=>"Detalles",
                'precio_general' => "3000000",
                'precio_invitado' => "30000",
                'max_especiales' => 2,
                'min_especiales' => 2,
                'nom_especiales' => "Novios"
            ]
        ];

        //Clico encargado de guardar los registros que se encuentran en el arreglo anterior
        foreach($tipos_evento as $tipo_evento){
            tipo_evento::create([
                'nombre'=>$tipo_evento['nombre'],
                'detallado'=>$tipo_evento['detallado'],
                'precio_general' => $tipo_evento['precio_general'],
                'precio_invitado' => $tipo_evento['precio_invitado'],
                'max_especiales' => $tipo_evento['max_especiales'],
                'min_especiales' => $tipo_evento['min_especiales'],
                'nom_especiales' => $tipo_evento['nom_especiales']
            ]);
        }
    }
}
