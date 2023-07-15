<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class salones extends Model
{
    use HasFactory;
    
    //Desactivar busqueda y llenado columnas create_at y update_at
    public $timestamps=false;

    /*
     * Método para obtener un salón disponible
     */
    public static function obtenerSalon($idSalon, $fechaIni, $fechaFin){
        // Llamando procedimiento
        $result = DB::select("CALL disponibles($idSalon, '$fechaIni', '$fechaFin');");

        // Validando que si haya una habitación disponible
        if(array_key_exists(0,$result)){
            return $result[0]->id;
        }

        // Retornando falso en caso de no haber habitaciones disponibles
        return false;
    }
}
