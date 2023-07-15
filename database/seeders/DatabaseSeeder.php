<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\espacio_reservacion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //Llenado Tabla Tipo de Documento
            tipo_documentosSeed::class,

            //Llenado Tabla Generos
            generosSeed::class,

            //Llenado Tabla Paises
            paisesSeed::class,

            //Creacion de Roles
            rolesPermisosSeed::class,

            //Llenado Tabla Usuarios
            usersSeed::class,

            //Llenado Tabla Tipo PQRS
            tipo_pqrsSeed::class,

            //Llenado Tabla Tipo Habitaciones
            tipo_habitacionSeed::class,

            //Llenado de la tabla estados_habitaciones
            estados_habitacionSeed::class,

            //Llenado Tabla Habitaciones
            habitacionesSeed::class,

            //Llenado tabla Tipo Salon
            tipo_salonSeed::class,

            //Llenado tabla Salones
            salonesSeed::class,

            //Llenado Tabla Estados Reserva
            estados_reservaSeed::class,

            //Llenado Tabla tipo evento
            tipo_eventoSeed::class,

            //Llenado Tabla Metodos de Pago
            metodos_pagoSeed::class,

            // Llenando tabla de complementos evento
            complementos_eventoSeed::class
        ]);
    }
}
