<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => $faker->word,
                'email' => $faker->email,
                'email_verified_at' => $faker->date(),
                'password' => $faker->word,
            ]);
        }
    }
}
