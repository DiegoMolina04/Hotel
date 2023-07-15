<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estados_habitacion extends Model
{
    use HasFactory;

    //Desactivacion campos Create_at y Update_at
    public $timestamps=FALSE;

    //Declaracion manual del nombre de la tabla
    public $table="estados_habitacion";
}
