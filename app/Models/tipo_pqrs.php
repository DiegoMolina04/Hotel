<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_pqrs extends Model
{
    //use HasFactory;
    
    protected $table="tipo_pqrs";
    protected $primaryKey="id";
    protected $fillable = [
        'nombre'
    ];

    //Desactivar busqueda y llenado columnas create_at y update_at
    public $timestamps=false;
}
