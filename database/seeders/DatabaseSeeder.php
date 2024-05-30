<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Location;
use App\Models\Measurement;
use App\Models\Feature;
use App\Models\Testimonial;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory(5)->create();

        User::create([
            'name' => 'Akhmadan Habibullah',
            'email' => 'akhmadanhabibullah@gmail.com',
            'username' => 'akhmadanh',
            'password' => bcrypt('password')
        ]);

        Location::factory(10)->create();

        Measurement::factory(20)->create();

    }
}
