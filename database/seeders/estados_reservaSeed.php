<?php

namespace Database\Seeders;

use App\Models\estados_reserva;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class estados_reservaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Registro: Activa
        $registro=new estados_reserva;
        $registro->nombre="Activa";
        $registro->save();

        //Registro: Cancelada
        $registro=new estados_reserva;
        $registro->nombre="Cancelada";
        $registro->save();

        //Registro: Consumida
        $registro=new estados_reserva;
        $registro->nombre="Consumida";
        $registro->save();

        //Registro: En consumo
        $registro=new estados_reserva;
        $registro->nombre="En consumo";
        $registro->save();

        //Registro: En espera de pago
        $registro=new estados_reserva;
        $registro->nombre="Pendiente por Pago";
        $registro->save();
        
    }
}
