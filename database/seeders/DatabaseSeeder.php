<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Cluster;
use App\Models\House;
use App\Models\Stand;
use App\Models\User;
use App\Models\VehicleEntrance;
use App\Models\VeicleEntrance;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Cluster::factory(10)->create();
        Stand::factory(20)->create();
        User::factory(20)->create();
        VehicleEntrance::factory(100)->create();
        House::factory(100)->create();
        Amenity::factory(40)->create();
        
        
    }
}
