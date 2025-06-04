<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "logradouro" => $this->faker->streetAddress(),
            "bairro"=> $this->faker->city(),
            "complemento"=> $this->faker->realTextBetween(1,28),
            "cliente_id"=>Cliente::inRandomOrder()->first()->id ?? Cliente::factory()
        ];
    }
}
