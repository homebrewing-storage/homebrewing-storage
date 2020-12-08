<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\Yeast;
use Illuminate\Database\Eloquent\Factories\Factory;

class YeastFactory extends Factory
{
    protected $model = Yeast::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type_id' => $this->faker->numberBetween(1, 4),
            'name' => $this->faker->word,
            'amount' => $this->faker->randomDigit,
            'expiration_date' => $this->faker->date(),
        ];
    }
}
