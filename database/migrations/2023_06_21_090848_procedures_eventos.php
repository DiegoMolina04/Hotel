<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Procedimiento para buscar el máximo de sillas en cierto salón
        DB::statement(
            "CREATE PROCEDURE MaxSillas( IN tipoSalon int)
            BEGIN 

            SELECT max_personas FROM tipo_salon WHERE id = tipoSalon LIMIT 1;

            END;
            "
        );

        //Procedimiento para buscar salones disponibles para reserva
        DB::statement(
            "CREATE PROCEDURE disponibles (IN tipoId int,IN dateStart datetime, IN dateEnd datetime)
            BEGIN 

            SELECT sal.id
            FROM salones sal
            LEFT JOIN evento_salon evsal ON sal.id = evsal.id_salon
            LEFT JOIN eventos ev ON ev.id = evsal.id_evento
            WHERE sal.id_tip_salon = tipoId
            AND (
                evsal.id_salon IS NULL
                OR (
                    ev.fecha_inicio > dateEnd 
                    OR ev.fecha_fin < dateStart
                    OR ev.id_estado_evento = 2
                    )
                )
            GROUP BY sal.id;


            END;
            "
        );

        // Obtener complementos en general y saber si están no seleccionadas en un evento
        DB::statement(
            "CREATE PROCEDURE complementos (IN idEvent int)
            BEGIN 
            SELECT ce.id, ce.nombre, evc.id_evento, evc.id as id_compEven FROM complementos_eventos ce 
            LEFT JOIN evento_complementos evc ON evc.id_complemento = ce.id 
            WHERE evc.id_evento = idEvent OR evc.id_evento IS NULL;
            END;
            "
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Borrar el procedimiento MaxSillas()
        DB::statement("DROP PROCEDURE IF EXISTS MaxSillas");

        //Borrar el procedimiento disponibles()
        DB::statement("DROP PROCEDURE IF EXISTS disponibles");

        //Borrar el procedimiento complementos()
        DB::statement("DROP PROCEDURE IF EXISTS complementos");
    }
};
