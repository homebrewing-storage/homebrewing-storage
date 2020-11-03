<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Hop;
use Illuminate\Database\Seeder;

class HopsTableSeeder extends Seeder
{
    public function run()
    {
        Hop::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            Hop::create([
                'name' => $faker->word,
                'amount' => $faker->randomDigit,
                'alpha_acid' => $faker->randomDigit,
                'expiration_date' => $faker->date(),
            ]);
        }
    }
}
