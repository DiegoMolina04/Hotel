<?php

namespace Database\Seeders;

use App\Models\metodos_pago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class metodos_pagoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Nota: Para agregar un tipo de evento, unicamente se debe, añadir dentro de este arreglo, siguiendo su estructura
        $metodos_pago=[
            ['nombre'=>"PayPal"],
            ['nombre'=>"MasterCard"],
            ['nombre' => "Pendiente"]
        ];

        //Clico encargado de guardar los registros que se encuentran en el arreglo anterior
        foreach($metodos_pago as $metodo_pago){
            metodos_pago::create([
                'nombre'=>$metodo_pago['nombre'],
            ]);
        }
    }
}
