<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Yeast;
use Illuminate\Database\Seeder;

class YeastsTableSeeder extends Seeder
{
    public function run(): void
    {
        Yeast::factory()->count(20)->create();
    }
}
