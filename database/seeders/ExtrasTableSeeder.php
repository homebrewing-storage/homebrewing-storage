<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Extra;
use Illuminate\Database\Seeder;

class ExtrasTableSeeder extends Seeder
{
    public function run(): void
    {
        Extra::factory()->count(20)->create();
    }
}
