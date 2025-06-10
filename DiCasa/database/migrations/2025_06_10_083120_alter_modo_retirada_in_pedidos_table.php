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
        Schema::table('pedidos', function (Blueprint $table) {
            // Remover o enum antigo e adicionar o novo
            $table->enum('modo_retirada', ['entrega', 'localmente'])
                  ->default('localmente')
                  ->change();
        });
    }

    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Reverter para o enum original se necessário
            $table->enum('modo_retirada', ['Entrega', 'Retirada'])
                  ->default('Retirada')
                  ->change();
        });
    }
};
