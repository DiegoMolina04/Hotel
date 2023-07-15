<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factura_evento extends Model
{
    use HasFactory;

    protected $table = "factura_evento";

    protected $fillable = [
        "fk_metodo_pago",
        "fk_evento",
        "paquete",
        "salon",
        "complementos",
        "subtotal",
        "valor_iva",
        "valor_total",
        "fk_metodo_pago"
    ];
}
