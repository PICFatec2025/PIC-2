<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(
            'pedidos',
            function (Blueprint $table) {
                $table->enum('modo_retirada',['Entrega','Retirada'])->default('localmente')->after('forma_pagamento');
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
                Schema::table(
            'pedidos',
            function (Blueprint $table) {
                $table->dropColumn('modo_retirada');
            }
        );
    }
};
