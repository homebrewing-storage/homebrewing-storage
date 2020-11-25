<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Fermentable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FermentableFactory extends Factory
{
    protected $model = Fermentable::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word,
            'type_id' => $this->faker->numberBetween(1, 5),
            'yield' => $this->faker->randomDigit,
            'ebc' => $this->faker->randomDigit,
            'amount' => $this->faker->randomDigit,
            'expiration_date' => $this->faker->date(),
        ];
    }
}
