<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class redirectUser extends Controller
{
    public function redirect(){

        //Consultar la Informacion del usuario que inicio sesion
        $usuario=User::find(Auth::user()->id);

        //Obtener todos los roles que posee en usuario y seleccionar la primera (y unica) opcion
        $rol=$usuario->getRoleNames()[0];

        //De acuerdo al rol del usuario, sera redirigido a su vista correspondiente
        switch($rol){
            case "coordinador_eventos":
                return redirect()->route("gestion-eventos.index");
            break;

            case "recepcionista":
                return redirect()->route("gestion-reservaciones.index");
            break;

            case "servicio_cliente":
                return redirect()->route("gestion-pqrs.index");
            break;

            case "coordinador_inventario":
                return redirect()->route("gestion-inventario.index");
            break;

            case "personal_aseo":
                return redirect()->route("index_habitaciones");
            break;

            case "cliente":
                return redirect()->route("dashboard-client");
            break;
/** */
        }
        
    }
}
