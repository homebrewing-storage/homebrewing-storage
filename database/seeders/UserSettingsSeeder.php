<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\UserSettings;
use Illuminate\Database\Seeder;

class UserSettingsSeeder extends Seeder
{
    public function run(): void
    {
        UserSettings::factory()->count(1)->create();
    }
}
