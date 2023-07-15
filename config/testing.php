<?php 

use Illuminate\Support\Facades\Facade;


/**
 * 
 * Archivo que retorna datos predefinidos para hacer pruebas
 * 
 * Es prescindible y eliminable
 * 
 */
return [

    'user' => (object) [
        'rol' => 0, //si es cliente enviar 0
        'name' => 'Juan David',
        'url_photo' => 'xd.jpeg'
    ]

];