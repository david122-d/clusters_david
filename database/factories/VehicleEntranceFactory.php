<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VeicleEntrance>
 */
class VehicleEntranceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clusters = [
            1 => ['stands' => [1, 2, 3], 'users' => [1, 2]],
            2 => ['stands' => [4, 5], 'users' => [3, 4]],
            3 => ['stands' => [6, 7, 8], 'users' => [5, 6]],
            4 => ['stands' => [9, 10], 'users' => [7, 8]],
            5 => ['stands' => [11, 12], 'users' => [9, 10]],
        ];
        
        $cluster_id = $this->faker->numberBetween(1, 5);
        $stands = $clusters[$cluster_id]['stands'];
        $users = $clusters[$cluster_id]['users'];
        
        $stand_id = $this->faker->randomElement($stands);
        $user_id = $this->faker->randomElement($users);
        
        return [
            'plates'=> $this->faker->numberBetween($min = 10000, $max = 99999),
            'reason'=> $this->faker->realText($maxNbChars = 200, $indexSize = 1),
            'check_in_time'=> $this->faker->dateTime($max = 'now', $timezone = null),
            'check_out_time'=> $this->faker->dateTime($max = 'now', $timezone = null),
            'cluster_id' => $cluster_id,
            'stand_id' => $stand_id,
            'user_id' => $user_id,

        ];
    }
}
