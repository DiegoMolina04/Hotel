<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pqrs extends Model
{
    protected $table="pqrs";
    protected $primaryKey="id";
    protected $fillable = [
        'id_tipo_pqrs', 'id_cliente', 'descripcion', 'id_trabajador', 'respuesta', 'created_at', 'updated_at'
    ];
}
