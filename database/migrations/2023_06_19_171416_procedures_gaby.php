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
            * Nombre Procedimiento: registrarUsuario()
            * Objetivo: Registrar nuevos usuarios
            * Nota: Este procedimiento solo crea los usuarios, mas no les ortorga roles o permisos
        */
            DB::statement("
                CREATE PROCEDURE registrarUsuario(IN nombre varchar(50),IN id_pais int,IN id_genero int,IN id_tip_doc int,IN numero_documento varchar(15),IN numero_telefonico varchar(15),IN fecha_nacimiento date,IN email varchar(255),IN password varchar(255),IN created_at timestamp,IN updated_at timestamp)

                BEGIN

                START TRANSACTION;
                    INSERT INTO users VALUES (null,nombre,id_pais,id_genero,id_tip_doc,numero_documento,numero_telefonico,fecha_nacimiento,email,null,password,null,null,null,null,null,updated_at,created_at);
                COMMIT;

                END;
            ");
        //

        /*
            * Nombre Procedimiento: consultarPaises()
            * Objetivo: Consultar tanto el Id como el nombre del Pais
        */
            DB::statement("
                CREATE PROCEDURE consultarPaises()
                BEGIN
                    SELECT id,nombre FROM paises;
                END;
            ");
        //

        /*
            * Nombre Procedimiento: consultarTipoDocumentos()
            * Objetivo: Consultar tanto el Id como el nombre del Pais
        */
            DB::statement("
                CREATE PROCEDURE consultarTipoDocumentos()
                BEGIN
                    SELECT id,nombre FROM tipo_documentos;
                END;
            ");
        //

        /*
            * Nombre Procedimiento: consultarGeneros()
            * Objetivo: Consultar tanto el Id como el nombre del genero
        */
            DB::statement("
                CREATE PROCEDURE consultarGeneros()
                BEGIN
                    SELECT id,nombre FROM generos;
                END;
            ");
        //

        /*
            * Nombre Procedimiento: consultarTipoHabitacionDisponibles()
            * Objetivo: Consultar la informacion de los tipo de habitacion junto con la cantidad de habitaciones disponibles
        */
            DB::statement("
                CREATE PROCEDURE consultarTipoHabitacionDisponibles()
                BEGIN
                    SELECT
                        tipo_habitacion.id,
                        tipo_habitacion.nombre,
                        tipo_habitacion.max_personas
                    FROM tipo_habitacion
                
                    INNER JOIN habitaciones
                    ON habitaciones.id_tip_hab=tipo_habitacion.id

                    INNER JOIN estados_habitacion
                    ON estados_habitacion.id=habitaciones.id_estado

                    WHERE estados_habitacion.nombre='libre'
                
                    GROUP BY id,nombre,max_personas,costo_base;
                END;
            ");
        //
    
        /*
            * Nombre Procedimiento: consultarTipoHabitacionDisponibles()
            * Objetivo: Consultar la informacion de los tipo de habitacion junto con la cantidad de habitaciones disponibles
        */
            DB::statement("
                CREATE PROCEDURE consultarCantidadHabDisponibles()
                BEGIN
                    SELECT
                        COUNT(habitaciones.id) as 'habitaciones_disponibles'
                    FROM habitaciones
                    
                    LEFT JOIN tipo_habitacion
                    ON tipo_habitacion.id=habitaciones.id_tip_hab
                    
                    INNER JOIN estados_habitacion
                    ON estados_habitacion.id=habitaciones.id_estado
                    
                    WHERE tipo_habitacion.id=1 AND estados_habitacion.nombre='libre';
                END;
            ");
        //

        /*
            * Nombre Procedimiento: consultarDatosHabDisponibles()
            * Objetivo: Consultar la informacion de las habitaciones que se encuentran disponibles segun el tipo de habitacion
        */
            DB::statement("
                CREATE PROCEDURE consultarDatosHabDisponibles(IN id_tipo_habitacion int)
                BEGIN
                    SELECT
                        habitaciones.id,
                        habitaciones.codigo,
                        tipo_habitacion.costo_base
                    FROM habitaciones
                    
                    INNER JOIN tipo_habitacion
                    ON tipo_habitacion.id=habitaciones.id_tip_hab
                    
                    INNER JOIN estados_habitacion
                    ON estados_habitacion.id=habitaciones.id_estado
                    
                    WHERE tipo_habitacion.id=id_tipo_habitacion AND estados_habitacion.nombre='libre';
                END;
            ");
        //

        /*
            * Nombre Procedimiento: registrarReserva()
            * Objetivo: Registrar los datos principales de la reserva
        */
            DB::statement("
                CREATE PROCEDURE registrarReserva(IN id_cliente int,IN fecha_inicio datetime, fecha_fin datetime, OUT id_generado INT)
                BEGIN
                    START TRANSACTION;
                        INSERT INTO reservas VALUES(null,id_cliente,fecha_inicio,fecha_fin,5,null,null);
                        SET id_generado=LAST_INSERT_ID();
                    COMMIT;
                END;
            ");
        //

        /*
            * Nombre Procedimiento: asociarHabReserva()
            * Objetivo: Asociar el id de la habitacion con el id de la reserva al interior de la tabla "habitacion_reserva"
        */
            DB::statement("
                CREATE PROCEDURE asociarHabReserva(IN id_hab int,IN id_reserva int)
                BEGIN
                    START TRANSACTION;
                        INSERT INTO habitacion_reserva VALUES (null,id_hab,id_reserva);

                        UPDATE habitaciones SET habitaciones.id_estado=1 WHERE id=id_hab;
                    COMMIT;
                END;
            ");
        //

        /*
            * Nombre Procedimiento: crearFacturaHab()
            * Objetivo: Crear la factura de la reserva de habitaciones y adjuntar sus respectivos valores 
        */
            DB::statement("
                CREATE PROCEDURE crearFacturaHab(IN id_reserva int,IN subtotal varchar(20),IN valor_iva varchar(20),IN valor_total varchar(20))
                BEGIN
                    START TRANSACTION;
                        INSERT INTO factura_habitacion values(null,id_reserva,subtotal,valor_iva,valor_total,null,null,null);
                    COMMIT;
                END;
            ");
        //

        /*
            * Nombre Procedimiento: borrarReservaFailed()
            * Objetivo: Este metodo tiene como fin borrar una reserva de habitacion en caso de no haber unidades suficientes de habitacion
        */
            DB::statement("
                CREATE PROCEDURE borrarReservaFailed(IN codigo_reserva int)
                BEGIN
                    START TRANSACTION;
                        DELETE FROM habitacion_reserva WHERE id_reserva=codigo_reserva;

                        DELETE FROM reservas WHERE id=codigo_reserva;
                    COMMIT;
                END;
            ");
        //

        /*
            * Nombre Procedimiento: consultarReservasActivas()
            * Objetivo: Este metodo tiene como funcion consultar todas aquellas reservas las cuales no hayan sido canceladas o ya se hayan consumido
        */
            DB::statement("
                CREATE PROCEDURE consultarReservasActivas(IN cod_cliente int)
                BEGIN
                    SELECT 
                        reservas.id,
                        reservas.fecha_inicio,
                        reservas.fecha_fin,
                        estados_reserva.nombre as 'estado_reserva',
                        factura_habitacion.valor_total
                    FROM reservas
                    
                    LEFT JOIN estados_reserva
                    ON estados_reserva.id=reservas.id_estado_reserva
                    
                    LEFT JOIN factura_habitacion
                    ON factura_habitacion.fk_reserva_habitacion=reservas.id
                    
                    WHERE reservas.id_cliente=cod_cliente AND reservas.id_estado_reserva<>2 AND reservas.id_estado_reserva<>3; 
                END;
            ");
        //

        /*
            * Nombre Procedimiento: validarReserva()
            * Objetivo: Este metodo tiene como funcion validar si existe una reserva segun el id entregado
        */
            DB::statement("
                CREATE PROCEDURE validarReserva(IN id_reserva int)
                BEGIN
                    SELECT 
                        reservas.id,
                        reservas.id_cliente,
                        estados_reserva.nombre as 'estado_reserva'
                    FROM reservas
                    
                    LEFT JOIN estados_reserva
                    ON estados_reserva.id=reservas.id_estado_reserva

                    WHERE reservas.id=id_reserva;
                END;
            ");
        //

        /*
            * Nombre Procedimiento: cancelarReserva()
            * Objetivo: Este metodo es el encargado de realizar el cambio en el estado de la reserva a "cancelado"
        */
            DB::statement("
                CREATE PROCEDURE cancelarReserva(IN id_reserva int)
                BEGIN
                    START TRANSACTION;
                        update reservas SET id_estado_reserva=2 WHERE id=id_reserva;
                    COMMIT;
                END;
            ");
        //

        /*
            * Nombre Procedimiento: consultarHabReserva()
            * Objetivo: Este metodo es el encargado de consultar la informacion de las habitaciones asociadas a una reserva
        */
            DB::statement("
                CREATE PROCEDURE consultarHabReserva(IN id_reserva_consulta int)
                BEGIN
                    SELECT
                        habitaciones.id,
                        tipo_habitacion.nombre as 'tipo_hab',
                        tipo_habitacion.max_personas,
                        habitaciones.codigo,
                        reservas.fecha_inicio,
                        reservas.fecha_fin,
                        reservas.id as 'id_reserva'
                    FROM habitaciones
                    
                    LEFT JOIN tipo_habitacion
                    ON tipo_habitacion.id=habitaciones.id_tip_hab
                    
                    LEFT JOIN habitacion_reserva
                    ON habitacion_reserva.id_habitacion=habitaciones.id
                    
                    LEFT JOIN reservas
                    ON reservas.id=habitacion_reserva.id_reserva
                    
                    WHERE reservas.id=id_reserva_consulta;   
                END;
            ");
        //

        /*
            * Nombre Procedimiento: cambiarEstadoHab()
            * Objetivo: Este metodo es el encargado de cambiar el estado de la habitacion
        */
            DB::statement("
                CREATE PROCEDURE cambiarEstadoHab(IN id_hab int,IN id_nuevo_estado int)
                BEGIN
                    START TRANSACTION;
                        update habitaciones SET id_estado=id_nuevo_estado WHERE habitaciones.id=id_hab;
                    COMMIT;
                END;
            ");
        //

        /*
            * Nombre Procedimiento: consultarTipoHabReserva()
            * Objetivo: Este metodo es el encargado de consultar que tipos de habitaciones a reservado el cliente y cuabtas unidades de cada una
        */
            DB::statement("
                CREATE PROCEDURE consultarTipoHabReserva(IN cod_cliente int)
                BEGIN
                    SELECT
                        reservas.fecha_inicio,
                        reservas.fecha_fin,
                        tipo_habitacion.id,
                        tipo_habitacion.nombre,
                        tipo_habitacion.max_personas,
                        count(habitaciones.id) as 'cantidad_habitaciones'
                    FROM tipo_habitacion
                
                    INNER JOIN habitaciones
                    ON habitaciones.id_tip_hab=tipo_habitacion.id

                    INNER JOIN estados_habitacion
                    ON estados_habitacion.id=habitaciones.id_estado

                    INNER JOIN habitacion_reserva
                    ON habitacion_reserva.id_habitacion=habitaciones.id

                    INNER JOIN reservas
                    ON habitacion_reserva.id_reserva=reservas.id

                    WHERE reservas.id_cliente=cod_cliente
                
                    GROUP BY id,nombre,max_personas,costo_base,reservas.fecha_inicio,reservas.fecha_fin;             
                END;
            ");
        //

        /*
            * Nombre Procedimiento: actualizarInfoReserva()

            * Objetivo: Este procedimiento tiene como objetivo actualizar la informacion basica de la reserva
        */
            DB::statement("
                CREATE PROCEDURE actualizarInfoReserva(
                    IN id_reserva int,
                    IN fecha_inicio_reserva datetime,
                    IN fecha_fin_reserva datetime
                )
                BEGIN
                    START TRANSACTION;
                        UPDATE reservas SET fecha_inicio=fecha_inicio_reserva, fecha_fin=fecha_fin_reserva WHERE id=id_reserva;
                    COMMIT;
                END;
            ");
        //

        /*
            * Nombre Procedimiento: actualizaFacturaReserva()

            * Objetivo: Este procedimiento tiene como objetivo actualizar la informacion de la factura de la reserva
        */
            DB::statement("
                CREATE PROCEDURE actualizaFacturaReserva(
                    IN id_reserva int,
                    IN valor_subtotal varchar(20),
                    IN iva varchar(20), 
                    IN total varchar(20)
                )
                BEGIN
                    START TRANSACTION;
                        UPDATE factura_habitacion SET subtotal=valor_subtotal, valor_iva=iva, valor_total=total WHERE fk_reserva_habitacion=id_reserva;
                    COMMIT;
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
        //Borrar el procedimiento registrarUsuario()
        DB::statement("DROP PROCEDURE IF EXISTS registrarUsuario");

        //Borrar el procedimiento consultarPaises()
        DB::statement("DROP PROCEDURE IF EXISTS consultarPaises");

        //Borrar el procedimiento consultarTipoDocumentos()
        DB::statement("DROP PROCEDURE IF EXISTS consultarTipoDocumentos");

        //Borrar el procedimiento consultarGeneros()
        DB::statement("DROP PROCEDURE IF EXISTS consultarGeneros");

        //Borrar el procedimiento consultarTipoHabitacionDisponibles()
        DB::statement("DROP PROCEDURE IF EXISTS consultarTipoHabitacionDisponibles");

        //Borrar el procedimiento consultarCantidadHabDisponibles()
        DB::statement("DROP PROCEDURE IF EXISTS consultarCantidadHabDisponibles");

        //Borrar el procedimiento consultarDatosHabDisponibles()
        DB::statement("DROP PROCEDURE IF EXISTS consultarDatosHabDisponibles");

        //Borrar el procedimiento registrarReserva()
        DB::statement("DROP PROCEDURE IF EXISTS registrarReserva");

        //Borrar el procedimiento asociarHabReserva()
        DB::statement("DROP PROCEDURE IF EXISTS asociarHabReserva");

        //Borrar el procedimiento crearFacturaHab()
        DB::statement("DROP PROCEDURE IF EXISTS crearFacturaHab");

        //Borrar el procedimiento borrarReservaFailed()
        DB::statement("DROP PROCEDURE IF EXISTS borrarReservaFailed");

        //Borrar el procedimiento consultarReservasActivas()
        DB::statement("DROP PROCEDURE IF EXISTS consultarReservasActivas");

        //Borrar el procedimiento validarReserva()
        DB::statement("DROP PROCEDURE IF EXISTS validarReserva");

        //Borrar el procedimiento cancelarReserva()
        DB::statement("DROP PROCEDURE IF EXISTS cancelarReserva");

        //Borrar el procedimiento consultarHabReserva()
        DB::statement("DROP PROCEDURE IF EXISTS consultarHabReserva");

        //Borrar el procedimiento cambiarEstadoHab()
        DB::statement("DROP PROCEDURE IF EXISTS cambiarEstadoHab");

        //Borrar el procedimiento consultarTipoHabReserva()
        DB::statement("DROP PROCEDURE IF EXISTS consultarTipoHabReserva");

        //Borrar el procedimiento actualizarInfoReserva()
        DB::statement("DROP PROCEDURE IF EXISTS actualizarInfoReserva");

        //Borrar el procedimiento actualizaFacturaReserva()
        DB::statement("DROP PROCEDURE IF EXISTS actualizaFacturaReserva");
    }
};
