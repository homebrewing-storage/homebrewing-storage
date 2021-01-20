<?php


namespace Database\Factories;


use App\Models\FermentableType;
use Illuminate\Database\Eloquent\Factories\Factory;

class FermentableTypeFactory extends Factory
{
    protected $model = FermentableType::class;

    public function definition(): array
    {
        return [

            'name' => $this->faker->word,
        ];
    }
}

