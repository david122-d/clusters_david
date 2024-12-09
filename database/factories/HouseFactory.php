<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number'=> $this->faker->numberBetween($min = 10, $max = 250),
            'owner_name'=> $this->faker->firstName(),
            'maintenance'=> $this->faker->randomElement(['pagado', 'no pagado']),
            'cluster_id' => $this->faker->numberBetween($min = 1, $max = 5),

        ];
    }
}
