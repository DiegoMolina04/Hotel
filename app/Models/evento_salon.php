<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evento_salon extends Model
{
    use HasFactory;

    //Desactivar busqueda y llenado columnas create_at y update_at
    public $timestamps=false;

    protected $table = "evento_salon";
    protected $fillable = [
        'id_salon',
        'id_evento',
    ];
}
