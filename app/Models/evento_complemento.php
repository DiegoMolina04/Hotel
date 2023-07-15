<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class evento_complemento extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_complemento',
        'id_evento'
    ];

    /*
     * Método para obtener un complementos de un evento
     */
    public static function complementosEvento($id){
        // Llamando procedimiento
        return DB::select("CALL complementos($id);");
    }
}
