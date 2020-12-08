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
            'type_1',
            'type_2',
            'type_3',
            'type_4',
        ];

        foreach ($extraTypes as $extraType) {
            ExtraType::create([
                'name' => $extraType,
            ]);
        }
    }
}
