<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estados_reserva extends Model
{
    use HasFactory;
    
    //Desactivar busqueda y llenado columnas create_at y update_at
    public $timestamps=false;

    //Definicion Manual del nombre de la tabla
    protected $table="estados_reserva";
}
