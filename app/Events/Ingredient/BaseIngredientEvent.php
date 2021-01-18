<?php

declare(strict_types=1);

namespace App\Events\Ingredient;

use App\Models\Ingredient;

abstract class BaseIngredientEvent
{
    private Ingredient $ingredient;

    public function __construct(Ingredient $ingredient)
    {
        $this->ingredient = $ingredient;
    }

    public function getIngredientName(): string
    {
        return $this->ingredient->name;
    }

    public function getIngredientType(): string
    {
        return $this->ingredient->getIngredientType();
    }
}
