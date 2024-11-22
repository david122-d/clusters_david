<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\stand>
 */
class standFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number'=> $this->faker->numberBetween($min = 1, $max = 20),
            'cluster_id' => $this->faker->numberBetween($min = 1, $max = 2),

        ];
    }
}
