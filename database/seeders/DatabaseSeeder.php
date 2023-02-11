<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Database\Seeders\CarSeeder::class);
        $this->call(\Database\Seeders\TripSeeder::class);
    }
}
