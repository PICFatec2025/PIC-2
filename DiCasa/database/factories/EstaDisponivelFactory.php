<?php

namespace Database\Factories;

use App\Models\Prato;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EstaDisponivel>
 */
class EstaDisponivelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "terca_feira" => $this->faker->boolean(),
            "quarta_feira" => $this->faker->boolean(),
            "quinta_feira" => $this->faker->boolean(),
            "sexta_feira" => $this->faker->boolean(),
            "sabado" => $this->faker->boolean(),
            "domingo" => $this->faker->boolean(),
            "prato_id" => Prato::inRandomOrder()->first()->id ?? Prato::factory(),
        ];
    }
}
