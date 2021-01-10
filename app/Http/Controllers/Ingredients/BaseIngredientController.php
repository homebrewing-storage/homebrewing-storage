<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Controller;
use App\Services\Ingredient\IngredientService;

abstract class BaseIngredientController extends Controller
{
    protected IngredientService $service;

    public function __construct(IngredientService $service)
    {
        $this->service = $service;
        $this->middleware('can:check,extra')->only(['show', 'update', 'destroy']);
    }
}
