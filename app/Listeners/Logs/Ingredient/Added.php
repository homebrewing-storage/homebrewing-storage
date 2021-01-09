<?php

declare(strict_types=1);

namespace App\Listeners\Logs\Ingredient;

class Added extends BaseIngredient
{
    protected string $message = "Successfully added new ingredient.";
}
