<?php

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Prato;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_preco', total: 8, places: 2);
            $table->decimal('taxa_entrega', total: 5, places: 2);
            $table->string('observacao', 500)->nullable();
            $table->enum('forma_pagamento', ['credito', 'debito', 'pix', 'dinheiro']);
            $table->boolean('foi_produzido')->default(0);
            $table->boolean('foi_entregue')->default(0);
            $table->foreignIdFor(Cliente::class)->constrained();
            $table->timestamps();
        });
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->foreignIdFor(User::class)->constrained();
        });
        Schema::create('telefones', function (Blueprint $table) {
            $table->id();
            $table->string('telefone', 14);
            $table->foreignIdFor(Cliente::class)->constrained();
        });
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('logradouro', 150);
            $table->string('bairro', 50)->nullable();
            $table->string('complemento', 30)->nullable();
            $table->foreignIdFor(Cliente::class)->constrained();
        });
        Schema::create('pratos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_prato', 50);
            $table->tinyText('descricao');
            $table->decimal('preco_p', 5, 2);
            $table->decimal('preco_m', 5, 2);
            $table->decimal('preco_g', 5, 2);
            $table->foreignIdFor(User::class)->constrained();
        });
        Schema::create('pedidos_pratos', function (Blueprint $table) {
            $table->foreignIdFor(Prato::class)->constrained();
            $table->foreignIdFor(Pedido::class)->constrained();
            $table->enum('tamanho', ['P', 'M', 'G']);
            $table->decimal('preco', 6, 2);
            $table->integer('quantidade');
            $table->primary(['prato_id', 'pedido_id', 'tamanho']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_pratos');
        Schema::dropIfExists('pedidos');
        Schema::dropIfExists('pratos');
        Schema::dropIfExists('telefones');
        Schema::dropIfExists('enderecos');
        Schema::dropIfExists('clientes');
    }
};
