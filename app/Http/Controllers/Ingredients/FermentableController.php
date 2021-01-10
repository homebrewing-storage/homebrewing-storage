<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Requests\Ingredients\FermentableRequest;
use App\Http\Resources\Fermentable\FermentableCollectionResource;
use App\Http\Resources\Fermentable\FermentableResource;
use App\Http\Resources\IngredientType\TypeResource;
use App\Models\Fermentable;
use App\Models\FermentableType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FermentableController extends BaseIngredientController
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $relation = $request->user()->fermentables();
        $fermentablesPaginate = $this->service->paginate($relation, (int)$perPage, (int)$page);
        return response()->json(new FermentableCollectionResource($fermentablesPaginate));
    }

    public function store(FermentableRequest $request): JsonResponse
    {
        $fermentable = $this->service->create($request->user()->fermentables(), $request->validated());
        return response()->json(new FermentableResource($fermentable), Response::HTTP_CREATED);
    }

    public function show(Fermentable $fermentable): JsonResponse
    {
        return response()->json(new FermentableResource($fermentable));
    }

    public function update(FermentableRequest $request, Fermentable $fermentable): JsonResponse
    {
        $fermentable->update($request->validated());
        return response()->json(new FermentableResource($fermentable), Response::HTTP_CREATED);
    }

    public function destroy(Fermentable $fermentable): JsonResponse
    {
        $fermentable->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function types(): JsonResponse
    {
        return response()->json(TypeResource::collection(FermentableType::all()));
    }
}
