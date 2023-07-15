<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodos_pago extends Model
{
    use HasFactory;

    //Desactivar busqueda y llenado columnas create_at y update_at
    public $timestamps=false;

    protected $table="metodos_pago";
}
