<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Ingredient;
use App\Models\User;

class IngredientPolicy
{
    public function check(User $user, Ingredient $ingredient): bool
    {
        return $ingredient->user()->is($user);
    }
}
