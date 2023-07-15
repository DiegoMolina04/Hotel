<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tipo_evento',
        'id_cliente',
        'fecha_inicio',
        'fecha_fin',
        'Numero_invitados',
        'id_estado_evento',
    ];
}
