<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Extra;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtraFactory extends Factory
{
    protected $model = Extra::class;

    public function definition(): array
    {
        return [
            'user_id' =>  User::factory(),
            'type_id' => $this->faker->numberBetween(1, 4),
            'name' => $this->faker->word,
            'amount' => $this->faker->randomDigit,
            'expiration_date' => $this->faker->date(),
        ];
    }
}
