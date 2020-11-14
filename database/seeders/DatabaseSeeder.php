<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(FermentablesTableSeeder::class);
        $this->call(HopsTableSeeder::class);
        $this->call(YeastsTableSeeder::class);
        $this->call(ExtrasTableSeeder::class);
    }
}
