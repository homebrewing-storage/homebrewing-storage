<?php

declare(strict_types=1);

namespace App\Events\Ingredient;

abstract class BaseIngredientEvent
{
    public string $ingredient;
    public string $type;

    public function __construct(string $ingredient, string $type)
    {
        $this->ingredient = $ingredient;
        $this->type = $type;
    }
}
