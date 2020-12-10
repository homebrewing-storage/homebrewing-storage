<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Ingredient;
use App\Models\User;

class IngredientPolicy
{
    public function check(User $user, Ingredient $extra): bool
    {
        return $user->id === $extra->user_id;
    }
}
