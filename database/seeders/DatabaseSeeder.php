<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            FermentableTypesTableSeeder::class,
            FermentablesTableSeeder::class,
            HopsTableSeeder::class,
            YeastsTableSeeder::class,
            ExtrasTableSeeder::class,
        ]);
    }
}
