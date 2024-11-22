<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amenity>
 */
class AmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> $this->faker->firstName(),
            'type'=> $this->faker->randomElement(['pool', 'tennis court','basketball court', 'gym', 'party hall', 'park', 'soccer field', 'little shop', 'skating rink', 'cinema', 'meeting room']),
            'status'=> $this->faker->randomElement(['active', 'disable','maintenance']),
            'cluster_id' => $this->faker->numberBetween($min = 1, $max = 5),

            
        ];
    }
}
