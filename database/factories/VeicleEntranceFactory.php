<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VeicleEntrance>
 */
class VeicleEntranceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plates'=> $this->faker->numberBetween($min = 10000, $max = 99999),
            'reason'=> $this->faker->realText($maxNbChars = 200, $indexSize = 1),
            'check_in_time'=> $this->faker->dateTime($max = 'now', $timezone = null),
            'check_out_time'=> $this->faker->dateTime($max = 'now', $timezone = null),
            'cluster_id' => $this->faker->numberBetween($min = 1, $max = 5),

        ];
    }
}
