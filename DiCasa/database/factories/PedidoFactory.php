<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "total_preco" => $this->faker->randomFloat(2,0,2000),
            "taxa_entrega"=> $this->faker->randomFloat(2,0,12),
            "observacao"=> $this->faker->realTextBetween(2,400),
            "forma_pagamento"=> $this->faker->randomElement(['credito', 'debito', 'pix', 'dinheiro']),
            "esta_produzindo"=> $this->faker->boolean(),
            "foi_entregue"=> $this->faker->boolean(),
            "foi_produzido"=> $this->faker->boolean(),
            "cliente_id"=>Cliente::inRandomOrder()->first()->id ?? Cliente::factory()
        ];
    }
}
