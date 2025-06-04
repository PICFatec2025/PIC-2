<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\Prato;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PedidoPrato>
 */
class PedidoPratoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "prato_id"=> Prato::inRandomOrder()->first()->id ?? Prato::factory(),
            "pedido_id"=> Pedido::inRandomOrder()->first()->id ?? Pedido::factory(),
            "tamanho"=> $this->faker->randomElement(['P', 'M', 'G']),
            'preco'=> $this->faker->randomFloat(2,0,1000),
            "quantidade"=> $this->faker->randomNumber()
        ];
    }
}
