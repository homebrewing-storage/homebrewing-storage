<?php


namespace Database\Factories;


use App\Models\User;
use App\Models\Yeast;
use App\Models\YeastType;
use Illuminate\Database\Eloquent\Factories\Factory;

class YeastTypeFactory extends Factory
{
    protected $model = YeastType::class;

    public function definition(): array
    {
        return [

            'name' => $this->faker->word,
        ];
    }
}
