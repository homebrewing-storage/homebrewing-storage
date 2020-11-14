<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Fermentable;
use Illuminate\Database\Seeder;

class FermentablesTableSeeder extends Seeder
{
    public function run(): void
    {
        Fermentable::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            Fermentable::create([
                'user_id' => $faker->numberBetween(1, 20),
                'name' => $faker->word,
                'type' => $faker->randomElement(['Grain', 'Sugar', 'Liquid extract', 'Dry extract', 'Adjunct']),
                'yield' => $faker->randomDigit,
                'ebc' => $faker->randomDigit,
                'amount' => $faker->randomDigit,
                'expiration_date' => $faker->date(),
            ]);
        }
    }
}
