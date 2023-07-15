<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authCustom;
use App\Http\Controllers\redirectUser;
//use Illuminate\Support\Facades\Route;

/*
    Nombre Archivo: web.php

    Objetivo: Este archivo contiene todas aquellas rutas las cuales podran ser consultadas tanto por usuarios auteticados, como aquellos que no.

    Rutas Contenidas:

        //Landing Page:
            1.  Pagina principal
            2.  Tipos de habitaciones
            3.  Eventos
            4.  Contacto
            5.  Sobre Nosotros
            6.  Paquetes Ofrecidos
            7.  Espacios Ofrecidos
        --
        
        //Rutas de Error:
            1. Error 500
            2. Error 403
        --

        //Rutas de Logueo:
            1. Inicio de sesión
            2. Registro
            3. Recepcion de los datos del formulario de registro
            4. Vista de redirección a los Dashboard's
        --
    --
*/

/* Rutas de Error */

    //Error del servidor
    Route::get('error500',function(){
        throw new Exception("Error de servidor", 500);
    });
    
    //Acceso denegado por permisos insuficientes
    Route::get('error403',function(){
        return abort('403');
    });

//

/* Rutas Landing Page */

    //Vista principal o home
    Route::get('/', function () {
        return view('landing_page.home');
    })->name("index");

    //Vista tipos de habitaciones ofrecidas
    Route::get('habitaciones', function () {
        return view('landing_page.rooms');
    })->name("rooms");

    //Vista eventos
    Route::get('eventos', function () {
        return view('landing_page.eventos');
    })->name("eventos");

    //Vista de contacto (Pendiente por revisión)
    Route::get('contactanos', function () {
        return view('landing_page.contact');
    })->name("contactanos");

    //Vista informacion del hotel
    Route::get('sobre-nosotros', function () {
        return view('landing_page.about_us');
    })->name("sobrenos");

    //Vista Paquetes ofrecidos
    Route::get('paquetes', function () {
        return view('landing_page.even_paqu');
    })->name("paquetes");

    //Vista Espacios Ofrecios
    Route::get('espacios', function () {
        return view('landing_page.even_espac');
    })->name("espacios");
//

/* Rutas habilitadas para usuarios no autenticados */

    Route::middleware(['guest'])->group(function () {

        //Vista de Inicio de sesión
        Route::get('/login-home', [authCustom::class,'viewLogin'])->name("viewLogin");

        //Vista Formualario de registro (Clientes)
        Route::get('/register', [authCustom::class,'viewRegister'])->name("viewRegister");

        //Vista receptora de los datos del formulario de registro
        Route::post('/register', [authCustom::class,'clientRegister'])->name("clientRegister");
    });
//

//Proteccion de acceso solo para usuarios logueados 
Route::middleware(['auth'])->group(function () {

    //Ruta de Redireccion al dashboard correspondiente segun el rol del usuario autenticado
    Route::get('/redirect', [redirectUser::class,'redirect'])->name("redirect");
});