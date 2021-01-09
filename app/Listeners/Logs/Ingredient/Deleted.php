<?php

declare(strict_types=1);

namespace App\Listeners\Logs\Ingredient;

class Deleted extends BaseIngredient
{
    protected string $message = "Successfully deleted ingredient.";
}
