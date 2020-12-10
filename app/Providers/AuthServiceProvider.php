<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Ingredient;
use App\Policies\IngredientPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Ingredient::class => IngredientPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
