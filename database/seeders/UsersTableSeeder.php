<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Extra;
use App\Models\Fermentable;
use App\Models\Hop;
use App\Models\User;
use App\Models\Yeast;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->times(20)
            ->has(Extra::factory()->count(5))
            ->has(Fermentable::factory()->count(5))
            ->has(Hop::factory()->count(5))
            ->has(Yeast::factory()->count(5))
            ->create();
    }
}
