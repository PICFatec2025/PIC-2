<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->timestamp('finalizado_em')->nullable()->after('finalizado');
    });
}
};
