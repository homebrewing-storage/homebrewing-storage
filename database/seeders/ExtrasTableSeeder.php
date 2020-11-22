<?php

namespace Database\Seeders;

use App\Models\Extra;
use Illuminate\Database\Seeder;

class ExtrasTableSeeder extends Seeder
{
    public function run(): void
    {
        Extra::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            Extra::create([
                'user_id' => $faker->numberBetween(1, 20),
                'type_id' => $faker->numberBetween(1, 4),
                'name' => $faker->word,
                'amount' => $faker->randomDigit,
                'expiration_date' => $faker->date(),
            ]);
        }
    }
}
