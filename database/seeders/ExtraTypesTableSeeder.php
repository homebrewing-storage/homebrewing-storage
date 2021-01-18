<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ExtraType;
use Illuminate\Database\Seeder;

class ExtraTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        $extraTypes = [
            'Spices',
            'Clarification',
            'Water factor',
            'Herb',
            'Flavoring',
            'Other'
        ];

        foreach ($extraTypes as $extraType) {
            ExtraType::create([
                'name' => $extraType,
            ]);
        }
    }
}
