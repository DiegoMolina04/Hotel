<?php

namespace Database\Seeders;

use App\Models\complementos_evento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class complementos_eventoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Registro: Complemento comida 
        $registro = new complementos_evento;
        $registro->nombre = "Comida";
        $registro->precio_general = "0";
        $registro->precio_invitado = "20000";
        $registro->save();

        // Registro: Complemento comida 
        $registro = new complementos_evento;
        $registro->nombre = "Audiovisual";
        $registro->precio_general = "20000";
        $registro->precio_invitado = "0";
        $registro->save();

        // Registro: Complemento comida 
        $registro = new complementos_evento;
        $registro->nombre = "Banda músical";
        $registro->precio_general = "100000";
        $registro->precio_invitado = "0";
        $registro->save();
    }
}
