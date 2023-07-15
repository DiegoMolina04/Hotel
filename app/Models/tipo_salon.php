<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class tipo_salon extends Model
{
    use HasFactory;
    
    //Desactivar busqueda y llenado columnas create_at y update_at
    public $timestamps=false;
    protected $table = "tipo_salon";

    /*
     * Método para obtener el número máximo de sillas de un salón especifico
     */
    public static function conseguirMaximo($id){
        return DB::select("CALL MaxSillas($id);")[0]->max_personas;
    }
}
