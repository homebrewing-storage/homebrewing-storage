<?php

declare(strict_types=1);

namespace App\Services\Ingredient;

use App\Models\Ingredient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IngredientService
{
    public function paginate(HasMany $relation, int $perPage, int $page): LengthAwarePaginator
    {
        return $relation->paginate($perPage, ['*'], 'page', $page);
    }

    public function create(HasMany $relation, array $data): Ingredient
    {
        return $relation->create($data);
    }

    public function update(Ingredient $ingredient, array $data): Ingredient
    {
        $ingredient->update($data);
        return $ingredient;
    }

    public function destroy(Ingredient $ingredient): void
    {
        $ingredient->delete();
    }
}
