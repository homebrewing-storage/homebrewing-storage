<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Yeast;
use Illuminate\Database\Seeder;

class YeastsTableSeeder extends Seeder
{
    public function run(): void
    {
        Yeast::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            Yeast::create([
                'user_id' => $faker->numberBetween(1, 20),
                'type_id' => $faker->numberBetween(1, 4),
                'name' => $faker->word,
                'amount' => $faker->randomDigit,
                'expiration_date' => $faker->date(),
            ]);
        }
    }
}
