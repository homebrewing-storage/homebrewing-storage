<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserSettings;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSettingsFactory extends Factory
{
    protected $model = UserSettings::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'reminder' => 7,
            'email' => true,
            'hop' => true,
            'yeast' => true,
            'fermentable' => true,
            'extra' => true,
        ];
    }
}
