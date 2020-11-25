<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Hop;
use Illuminate\Database\Seeder;

class HopsTableSeeder extends Seeder
{
    public function run(): void
    {
        Hop::factory()->count(20)->create();
    }
}
