<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            "name"=>"hamid",
            "email"=>"admin@gmail.com",
            "password"=> Hash::make("123456")
        ]);

        \App\Models\User::factory()->create([
            "name"=>"User 1",
            "email"=>"user1@gmail.com",
            "password"=> Hash::make("789456")
        ]);


    }
}
