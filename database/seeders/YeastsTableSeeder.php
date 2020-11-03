<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Yeast;
use Illuminate\Database\Seeder;

class YeastsTableSeeder extends Seeder
{
    public function run()
    {
        Yeast::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            Yeast::create([
                'name' => $faker->word,
                'type' => $faker->randomElement(['Liquid', 'Dry', 'Slant', 'Culture']),
                'amount' => $faker->randomDigit,
                'expiration_date' => $faker->date(),
            ]);
        }
    }
}
