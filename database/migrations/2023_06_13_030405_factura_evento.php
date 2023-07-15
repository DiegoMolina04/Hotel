<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_evento', function (Blueprint $table) {
            //Llave Primaria
            $table->id();

            //Campos Personalizados
            $table->unsignedBigInteger("fk_evento")->comment("Fk Id Evento")->unique();
            $table->string("paquete",10)->comment("Valor del paquete adquirido para el evento");
            $table->string("salon",10)->comment("Valor del alquiler del salón");
            $table->string("complementos",10)->comment("Valor de los complementos adquiridos");
            $table->string("subtotal",10)->comment("Valor Neto del Evento");
            $table->string("valor_iva",10)->comment("Valor Iva");
            $table->string("valor_total")->comment("Valor Final");
            $table->unsignedBigInteger("fk_metodo_pago")->comment("Fk Id metodo de Pago");

            //Campos Create_at y Update_at
            $table->timestamps();

            //Creacion Llaves Foraneas
            $table->foreign("fk_evento")->references("id")->on("eventos");
            $table->foreign("fk_metodo_pago")->references("id")->on("metodos_pago");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_evento');
    }
};
