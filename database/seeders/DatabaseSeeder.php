<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Cluster;
use App\Models\House;
use App\Models\Stand;
use App\Models\User;
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
        Cluster::factory(5)->create();
        Stand::factory(20)->create();
        User::factory(10)->create();
        VeicleEntrance::factory(10);
        House::factory(100)->create();
        Amenity::factory(20)->create();
        
        
    }
}
