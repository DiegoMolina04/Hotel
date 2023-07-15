<?php

use App\Http\Controllers\clients\eventosController;
use App\Http\Controllers\clients\asistentesEvento;
use App\Http\Controllers\clients\pqrsController;
use App\Http\Controllers\clients\reservationsController;
use Illuminate\Support\Facades\Route;

/*
    Nombre Archivo: clients.php

    Objetivo: Este archivo contiene todas aquellas rutas las cuales seran accedidas unicamente por clientes autenticados

    Prefijo: clients/

    Nota: En caso de necesitar explicacion relacionada con el funcionamiento de los prefijos en laravel, su documentacon se encuentra en el archivo app\Providers\RouteServiceProvider.php al interior del metodo "boot"

    Rutas Contenidas:

        Modulos Accesibles:
            1. Gestion de Reserva de habitaciones (Version Cliente)
            2. Gestion de Reserva de eventos/espacios (Version Cliente)
            3. Gestion de PQRS (Version Cliente)
        --
        
    --
*/

//Proteccion de rutas tanto por sesion iniciada como por permiso especifico
Route::middleware(['role:cliente'])->group(function () {

    //Rutas Modulo gestion de reserva de habitaciones (Version Cliente)

        /*
            Ruta Resource: Complejo de rutas que abarca las principales funcionalidades del modulo:

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
        Route::resource('/reservations',reservationsController::class);

        Route::post('/addcomplement/{evento}',[EventosController::class, 'addComplement'])->name('addComp');

        Route::delete('/deletecomplement/{id}',[EventosController::class, 'deleteComplement'])->name('delComp');

        Route::post('/addInvitado/{evento}',[asistentesEvento::class, 'agregarInvitado'])->name('addAsist');

        Route::get('/CreateInvitado/{evento}',[asistentesEvento::class, 'vistaAgregarInvitado'])->name('ViewAddAsist');

        //Ruta Resource CRUD invitados
        Route::resource('/{evento}/invitados', AsistentesEvento::class);     
    //

    //Rutas Modulo gestion de reservas de eventos/espacios (Version Cliente)

        /*
            Ruta Resource: Complejo de rutas que abarca las principales funcionalidades del modulo:

                Rutas Get (Consultar Vistas):

                    1. Index: 
                    2. Create: 
                    3. Show: (Sin actualizacion)
                    4. Edit: 

                --

                Rutas POST/PUT/PATCH/DELETE (Recibir los datos de las vistas):

                    1. Store: Recibir la informacion del formulario de creacion de 

                    2. Update: Recibir la informacion del formulario de actualizacion/modificacion de

                    3. Delete: Recibir la solicitud de cancelacion de 

                --

            --
        */
        Route::resource('/eventos',eventosController::class);

    //

    //Rutas Modulo gestion de PQRS (Version Cliente)

        /*
            Ruta Resource: Complejo de rutas que abarca las principales funcionalidades del modulo:

                Rutas Get (Consultar Vistas):

                    1. Index: 
                    2. Create: 
                    3. Show: (Sin actualizacion)
                    4. Edit: 

                --

                Rutas POST/PUT/PATCH/DELETE (Recibir los datos de las vistas):

                    1. Store: Recibir la informacion del formulario de creacion de 

                    2. Update: Recibir la informacion del formulario de actualizacion/modificacion de

                    3. Delete: Recibir la solicitud de cancelacion de 

                --

            --
        */
        //Route::post('/addcomplement/{evento}',[EventosController::class, 'addComplement'])->name('addComp');
        Route::resource('/pqrs',pqrsController::class);
        //Route::get('/pqrs',[pqrsController::class, 'index']);
        //Route::post('/pqrs/new',[pqrsController::class, 'store'])->name('store');
        //Route::post('/register', [authCustom::class,'clientRegister'])->name("clientRegister");
    //

    //Ruta de acceso al dashboard de los clientes
    Route::get('/dashboard', function () {
        return view("clients.dashboard");
    })->name("dashboard-client");

});

