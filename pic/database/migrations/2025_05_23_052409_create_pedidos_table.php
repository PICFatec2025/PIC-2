<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente');
            $table->string('pedido');
            $table->time('hora');
            $table->enum('tipo', ['Entrega', 'Retirada']);
            $table->boolean('produzindo')->default(false);
            $table->boolean('pronto')->default(false);
            $table->boolean('entregue')->default(false);
            $table->boolean('finalizado')->default(false)->after('entregue');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};
