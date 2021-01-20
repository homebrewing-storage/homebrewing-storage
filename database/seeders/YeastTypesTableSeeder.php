<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\YeastType;
use Illuminate\Database\Seeder;

class YeastTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        $yeastTypes = [
            'Liquid',
            'Dry',
            'Slant',
            'Culture'
        ];

        foreach ($yeastTypes as $yeastType) {
            YeastType::create([
                'name' => $yeastType,
            ]);
        }
    }
}
