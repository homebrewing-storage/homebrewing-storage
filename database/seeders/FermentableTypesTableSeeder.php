<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FermentableType;
use Illuminate\Database\Seeder;

class FermentableTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        $fermentableTypes = [
            'Grain',
            'Sugar',
            'Liquid extract',
            'Dry extract',
            'Adjunct'
        ];

        foreach ($fermentableTypes as $fermentableType) {
            FermentableType::create([
                'name' => $fermentableType,
            ]);
        }
    }
}
