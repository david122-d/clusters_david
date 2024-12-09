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
            'type'=> $this->faker->randomElement(['piscina', 'cancha de tenis', 'cancha de baloncesto', 'gimnasio', 'salón de fiestas', 'parque', 'campo de fútbol', 'pequeña tienda', 'pista de patinaje', 'cine', 'sala de reuniones', 'jardin']),
            'status'=> $this->faker->randomElement(['activa', 'inactiva','En mantenimiento']),
            'cluster_id' => $this->faker->numberBetween($min = 1, $max = 5),

            
        ];
    }
}
