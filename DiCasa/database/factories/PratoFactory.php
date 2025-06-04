<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prato>
 */
class PratoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nome_prato"=> $this->faker->realTextBetween(1,48),
            "descricao"=> $this->faker->realTextBetween(1,200),
            "preco_p"=> $this->faker->randomFloat(2,10,100),
            "preco_m"=> $this->faker->randomFloat(2,10,100),
            "preco_g"=> $this->faker->randomFloat(2,10,100),
            "user_id"=> User::inRandomOrder()->first()->id ?? User::factory()
        ];
    }
}
