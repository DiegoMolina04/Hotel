<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
            * Nombre Procedimiento: pedirDatosHabitacionIndividual()
            * Objetivo: Pedir id, estado y tipo de habitacion 
            * Nota: Pedir id, estado y tipo de habitacion de habitaciones individuales
        */
        DB::statement("
            CREATE PROCEDURE pedirDatosHabitacionIndividual()

            BEGIN
            SELECT habitaciones.id, 
            tipo_habitacion.nombre as Tipo, 
            estados_habitacion.nombre as Estado
            FROM habitaciones 
            LEFT JOIN tipo_habitacion
            ON habitaciones.id_tip_hab = tipo_habitacion.id 
            LEFT JOIN estados_habitacion 
            ON habitaciones.id_estado = estados_habitacion.id
            WHERE tipo_habitacion.nombre = 'individual';

    


            END;
        ");
             /*
            * Nombre Procedimiento: ActualizarDatos()
            * Objetivo: Actualizar datos de las habitaciones
            * Nota: Actualizar datos de las habitaciones
        */
        DB::statement("
            CREATE PROCEDURE ActualizarDatos(IN id_hab int,IN tip_hab int, IN est_ant int ,IN est_act int,IN id_user int)

            BEGIN
            INSERT INTO historial_habitaciones (Numero_Habitacion, Tipo_habitacion,Estado_Anterior,Estado_Actual,Actualizado_Por)
            VALUES (id_hab, tip_hab, est_ant ,est_act,id_user);

    


            END;
        ");

          /*
            * Nombre Procedimiento: pedirDatosHabitacionDoble()
            * Objetivo: Pedir id, estado y tipo de habitacion 
            * Nota: Pedir id, estado y tipo de habitacion de habitaciones doble
        */
        DB::statement("
            CREATE PROCEDURE pedirDatosHabitacionDoble()

            BEGIN
            SELECT habitaciones.id, 
            tipo_habitacion.nombre as Tipo, 
            estados_habitacion.nombre as Estado 
            FROM habitaciones 
            LEFT JOIN tipo_habitacion
            ON habitaciones.id_tip_hab = tipo_habitacion.id 
            LEFT JOIN estados_habitacion 
            ON habitaciones.id_estado = estados_habitacion.id
            WHERE tipo_habitacion.nombre = 'doble';

    


            END;
        ");

          /*
            * Nombre Procedimiento: pedirDatosHabitacionDobleTwing()
            * Objetivo: Pedir id, estado y tipo de habitacion 
            * Nota: Pedir id, estado y tipo de habitacion de habitaciones dobleTwing
        */
        DB::statement("
            CREATE PROCEDURE pedirDatosHabitacionDobleTwing()

            BEGIN
            SELECT habitaciones.id, 
            tipo_habitacion.nombre as Tipo, 
            estados_habitacion.nombre as Estado
            FROM habitaciones 
            LEFT JOIN tipo_habitacion
            ON habitaciones.id_tip_hab = tipo_habitacion.id 
            LEFT JOIN estados_habitacion 
            ON habitaciones.id_estado = estados_habitacion.id
            WHERE tipo_habitacion.nombre = 'Doble Twing';

    


            END;
        ");

           /*
            * Nombre Procedimiento: pedirDatosHabitacionEmpresarial()
            * Objetivo: Pedir id, estado y tipo de habitacion 
            * Nota: Pedir id, estado y tipo de habitacion de habitaciones Empresarial
        */
        DB::statement("
            CREATE PROCEDURE pedirDatosHabitacionEmpresarial()

            BEGIN
            SELECT habitaciones.id, 
            tipo_habitacion.nombre as Tipo, 
            estados_habitacion.nombre as Estado
            FROM habitaciones 
            LEFT JOIN tipo_habitacion
            ON habitaciones.id_tip_hab = tipo_habitacion.id 
            LEFT JOIN estados_habitacion 
            ON habitaciones.id_estado = estados_habitacion.id
            WHERE tipo_habitacion.nombre = 'Empresarial';

    


            END;
        ");

           /*
            * Nombre Procedimiento: pedirDatosHabitacionMatrimonial()
            * Objetivo: Pedir id, estado y tipo de habitacion 
            * Nota: Pedir id, estado y tipo de habitacion de habitaciones Matrimonial
        */
        DB::statement("
            CREATE PROCEDURE pedirDatosHabitacionMatrimonial()

            BEGIN
            SELECT habitaciones.id, 
            tipo_habitacion.nombre as Tipo, 
            estados_habitacion.nombre as Estado 
            FROM habitaciones 
            LEFT JOIN tipo_habitacion
            ON habitaciones.id_tip_hab = tipo_habitacion.id 
            LEFT JOIN estados_habitacion 
            ON habitaciones.id_estado = estados_habitacion.id
            WHERE tipo_habitacion.nombre = 'Matrimonial';

    


            END;
        ");

            /*
            * Nombre Procedimiento: pedirDatosHabitacionSuite()
            * Objetivo: Pedir id, estado y tipo de habitacion 
            * Nota: Pedir id, estado y tipo de habitacion de habitaciones Suite
        */
        DB::statement("
            CREATE PROCEDURE pedirDatosHabitacionSuite()

            BEGIN
            SELECT habitaciones.id, 
            tipo_habitacion.nombre as Tipo, 
            estados_habitacion.nombre as Estado
            FROM habitaciones 
            LEFT JOIN tipo_habitacion
            ON habitaciones.id_tip_hab = tipo_habitacion.id 
            LEFT JOIN estados_habitacion 
            ON habitaciones.id_estado = estados_habitacion.id
            WHERE tipo_habitacion.nombre = 'Suite';

    


            END;
        ");


        
            /*
            * Nombre Procedimiento: actualizarEstado()
            * Objetivo: actualizarEstado
            * Nota: actualizarEstado
        */
        DB::statement("
            CREATE PROCEDURE actualizarEstado(IN estado int,IN id_habitacion int)

            BEGIN
            UPDATE habitaciones SET id_estado = estado WHERE id = id_habitacion; 
            END;
        ");
//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Borrar el procedimiento ()
        DB::statement("DROP PROCEDURE IF EXISTS pedirDatosHabitacionIndividual");        
        DB::statement("DROP PROCEDURE IF EXISTS pedirDatosHabitacionDoble");
        DB::statement("DROP PROCEDURE IF EXISTS actualizarEstado");
        DB::statement("DROP PROCEDURE IF EXISTS pedirDatosHabitacionDobleTwing");
        DB::statement("DROP PROCEDURE IF EXISTS ActualizarDatos");

        DB::statement("DROP PROCEDURE IF EXISTS pedirDatosHabitacionEmpresarial");
        DB::statement("DROP PROCEDURE IF EXISTS pedirDatosHabitacionMatrimonial");
        DB::statement("DROP PROCEDURE IF EXISTS pedirDatosHabitacionSuite");

    }
};
