<?php

namespace Database\Seeders;

use App\Models\Cooperative;
use App\Models\Driver;
use App\Models\Farmer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::factory(50)->create();
        Cooperative::factory(50)->create();
        Farmer::factory(1000)->create();
        Driver::factory(1000)->create();
        Product::factory(500)->create();

    }
}
