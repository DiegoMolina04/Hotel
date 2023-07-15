<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_evento extends Model
{
    use HasFactory;

    //Desactivar busqueda y llenado columnas create_at y update_at
    public $timestamps=false;
    protected $table = "tipo_evento";
}
