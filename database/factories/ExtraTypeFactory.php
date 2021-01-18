<?php


namespace Database\Factories;


use App\Models\ExtraType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtraTypeFactory  extends Factory
{
    protected $model = ExtraType::class;

    public function definition(): array
    {
        return [

            'name' => $this->faker->word,
        ];
    }
}

