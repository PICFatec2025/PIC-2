<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente');
            $table->text('pedido');
            $table->time('hora');
            $table->string('tipo'); // 'entrega' ou 'retirada'
            $table->boolean('produzindo')->default(false);
            $table->boolean('pronto')->default(false);
            $table->boolean('entregue')->default(false);
            $table->boolean('finalizado')->default(false);
            $table->timestamp('finalizado_em')->nullable();
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};