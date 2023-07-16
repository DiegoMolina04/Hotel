<?php

use App\Http\Controllers\admin\gestionEventosController;
use App\Http\Controllers\admin\gestionHabitacionesController;
use App\Http\Controllers\admin\gestionInventariosController;
use App\Http\Controllers\admin\gestionPqrsController;
use App\Http\Controllers\admin\gestionReservasController;
use Illuminate\Support\Facades\Route;

/*
    Nombre Archivo: admin.php

    Objetivo: Este archivo contiene todas aquellas rutas las cuales seran accedidas unicamente por los trabajadores del hotel

    Prefijo: admin/

    Nota: En caso de necesitar explicacion relacionada con el funcionamiento de los prefijos en laravel, su documentacon se encuentra en el archivo app\Providers\RouteServiceProvider.php al interior del metodo "boot"

    Aclaracion: Si bien, este archivo esta diseñado para contener todas las rutas del personal del hotel, internamente el cojunto de rutas correspondiente a cada modulo esta protegido de forma individual segun un permiso especifico

    Rutas Contenidas:

        Modulos Accesibles:
            1. Gestion de Reserva de habitaciones (Version Recepcionista)

            2. Gestion de Reserva de eventos/espacios (Version Coordinador de Eventos)

            3. Gestion de Inventario (Version Coordinador de Inventarios)

            4. Gestion de estado de las habitaciones (Version personal de Aseo)

            5. Gestion de PQRS (Version personal de servicio al cliente)
        --
        
    --
*/

/*
    Rutas Middelware Group: Estas rutas cumplen la funcion de aplicar una misma proteccion a las subrutas que se encuentran en su interior

    Permisos Requeridos:
        1. auth -> Sesion Iniciada
    --
*/
Route::middleware(['auth'])->group(function () {

    /*
        Permisos requeridos:
            1. role:recepcionista -> El usuario autenticado debe tener asigando el rol "recepcionista" para acceder a las subrutas
        --
    */
    Route::middleware(['role:recepcionista'])->group(function () {

        /*
            Ruta Resource: Complejo de rutas que abarca las principales funcionalidades del modulo de gestion de reserva de habitaciones:

                Rutas Get (Consultar Vistas):

                    1. Index: Vista de Reservas Activas
                    2. Create: Vista de creación de una reserva
                    3. Show: Vista de consulta de la informacion de una reserva (Sin actualizacion)
                    4. Edit: Vista de actualización o modificacion de una reserva

                --

                Rutas POST/PUT/PATCH/DELETE (Recibir los datos de las vistas):

                    1. Store: Recibir la informacion del formulario de creacion de una reserva

                    2. Update: Recibir la informacion del formulario de actualizacion/modificacion de una reserva

                    3. Delete: Recibir la solicitud de cancelacion de una reserva

                --

            --
        */
        Route::resource('/gestion-reservaciones', gestionReservasController::class);

    });
    
    /*
        Permisos requeridos:
            1. role:coordinadorEventos-> El usuario autenticado debe tener asigando el rol "coordinadorEventos" para acceder a las subrutas
        --
    */
    Route::middleware(['role:coordinador_eventos'])->group(function () {

        /*
            Ruta Resource: Complejo de rutas que abarca las principales funcionalidades del modulo de gestion de reservas de eventos/espacios:

                Rutas Get (Consultar Vistas):

                    1. Index: Vista de 
                    2. Create: Vista de 
                    3. Show: Vista de (Sin actualizacion)
                    4. Edit: Vista de 

                --

                Rutas POST/PUT/PATCH/DELETE (Recibir los datos de las vistas):

                    1. Store: Recibir la informacion del formulario de creacion de 

                    2. Update: Recibir la informacion del formulario de actualizacion/modificacion de 

                    3. Delete: Recibir la solicitud de cancelacion de 

                --

            --
        */
        Route::resource('/gestion-eventos',gestionEventosController::class);

    });

    /*
        Permisos requeridos:
            1. role:personalAseo -> El usuario autenticado debe tener asigando el rol "personaAseo" para acceder a las subrutas
        --
    */
    Route::middleware(['role:personal_aseo'])->group(function () {

        /*
            Ruta Resource: Complejo de rutas que abarca las principales funcionalidades del gestion de Habitaciones:

                Rutas Get (Consultar Vistas):

                    1. Index: Vista de 
                    2. Create: Vista de 
                    3. Show: Vista de (Sin actualizacion)
                    4. Edit: Vista de 

                --

                Rutas POST/PUT/PATCH/DELETE (Recibir los datos de las vistas):

                    1. Store: Recibir la informacion del formulario de creacion de 

                    2. Update: Recibir la informacion del formulario de actualizacion/modificacion de 

                    3. Delete: Recibir la solicitud de cancelacion de 

                --

            --
        */
        Route::get('/gestion-habitaciones', [gestionHabitacionesController::class,"index"])->name("index_habitaciones");

        Route::get('/data',[gestionHabitacionesController::class,'datos']);

        Route::put('/estado-cambio/{id}',[gestionHabitacionesController::class,'estado'])->name("estado");


    });

    /*
        Permisos requeridos:
            1. role:coordinadorInventario -> El usuario autenticado debe tener asigando el rol "coordinadorInventario" para acceder a las subrutas
        --
    */
    Route::middleware(['role:coordinador_inventario'])->group(function () {

        /*
            Ruta Resource: Complejo de rutas que abarca las principales funcionalidades del gestion de Inventarios:

                Rutas Get (Consultar Vistas):

                    1. Index: Vista de 
                    2. Create: Vista de 
                    3. Show: Vista de (Sin actualizacion)
                    4. Edit: Vista de 

                --

                Rutas POST/PUT/PATCH/DELETE (Recibir los datos de las vistas):

                    1. Store: Recibir la informacion del formulario de creacion de 

                    2. Update: Recibir la informacion del formulario de actualizacion/modificacion de 

                    3. Delete: Recibir la solicitud de cancelacion de 

                --

            --
        */
        Route::resource('/gestion-inventario',gestionInventariosController::class);

    });

    /*
        Permisos requeridos:
            1. role:servicioCliente -> El usuario autenticado debe tener asigando el rol "coordinadorInventario" para acceder a las subrutas
        --
    */
    Route::middleware(['role:servicio_cliente'])->group(function () {

        /*
            Ruta Resource: Complejo de rutas que abarca las principales funcionalidades del gestion de las PQRS:

                Rutas Get (Consultar Vistas):

                    1. Index: Vista de 
                    2. Create: Vista de 
                    3. Show: Vista de (Sin actualizacion)
                    4. Edit: Vista de 

                --

                Rutas POST/PUT/PATCH/DELETE (Recibir los datos de las vistas):

                    1. Store: Recibir la informacion del formulario de creacion de 

                    2. Update: Recibir la informacion del formulario de actualizacion/modificacion de 

                    3. Delete: Recibir la solicitud de cancelacion de 

                --

            --
        */
        Route::resource('/gestion-pqrs',gestionPqrsController::class);
        //Route::post('/gestion-pqrs/destroyView/{id}',[gestionPqrsController::class,'destroyView'])->name("destroyView");

    });
});