<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Hop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HopFactory extends Factory
{
    protected $model = Hop::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word,
            'amount' => $this->faker->randomDigit,
            'alpha_acid' => $this->faker->randomDigit,
            'expiration_date' => $this->faker->date(),
        ];
    }
}
