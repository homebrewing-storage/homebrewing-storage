<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Fermentable;
use Illuminate\Database\Seeder;

class FermentablesTableSeeder extends Seeder
{
    public function run(): void
    {
        Fermentable::factory()->count(20)->create();
    }
}
