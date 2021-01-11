<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Contracts\YeastInterface;
use App\Http\Requests\Ingredients\YeastRequest;
use App\Http\Resources\IngredientType\TypeResource;
use App\Http\Resources\Yeast\YeastCollectionResource;
use App\Http\Resources\Yeast\YeastResource;
use App\Models\Yeast;
use App\Models\YeastType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class YeastController extends BaseIngredientController implements YeastInterface
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $relation = $request->user()->yeasts();
        $yeastsPaginate = $this->service->paginate($relation, (int)$perPage, (int)$page);
        return response()->json(new YeastCollectionResource($yeastsPaginate));
    }

    public function store(YeastRequest $request): JsonResponse
    {
        $yeast = $this->service->create($request->user()->yeasts(), $request->validated());
        return response()->json(new YeastResource($yeast), Response::HTTP_CREATED);
    }

    public function show(Yeast $yeast): JsonResponse
    {
        return response()->json(new YeastResource($yeast));
    }

    public function update(YeastRequest $request, Yeast $yeast): JsonResponse
    {
        $yeast->update($request->validated());
        return response()->json(new YeastResource($yeast), Response::HTTP_CREATED);
    }

    public function destroy(Yeast $yeast): JsonResponse
    {
        $yeast->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function types(): JsonResponse
    {
        return response()->json(TypeResource::collection(YeastType::all()));
    }
}
