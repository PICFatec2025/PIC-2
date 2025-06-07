<?php

use App\Models\Prato;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('esta_disponiveis', function (Blueprint $table) {
            $table->id();
            $table->boolean('terca_feira');
            $table->boolean('quarta_feira');
            $table->boolean('quinta_feira');
            $table->boolean('sexta_feira');
            $table->boolean('sabado');
            $table->boolean('domingo');
            $table->timestamps();
            $table->foreignIdFor(Prato::class)->constrained();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('eh_admin')->default(false)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esta_disponiveis');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('eh_admin');
        });
    }
};
