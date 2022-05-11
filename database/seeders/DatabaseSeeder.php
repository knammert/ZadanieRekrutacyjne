<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\DataSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            // UserSeeder::class
            DataSeeder::class
         ]);
        // \App\Models\User::factory(10)->create();


    }
}
