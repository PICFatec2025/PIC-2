<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::table('pratos', function (Blueprint $table) {
            $table->boolean('disponivel')->default(true);
        });
    }

    public function down()
    {
        Schema::table('pratos', function (Blueprint $table) {
            $table->dropColumn('disponivel');
        });
    }

};
