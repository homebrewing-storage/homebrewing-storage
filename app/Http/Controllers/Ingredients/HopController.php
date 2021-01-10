<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Requests\Ingredients\HopRequest;
use App\Http\Resources\Hop\HopCollectionResource;
use App\Http\Resources\Hop\HopResource;
use App\Models\Hop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HopController extends BaseIngredientController
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $relation = $request->user()->hops();
        $hopsPaginate = $this->service->paginate($relation, (int)$perPage, (int)$page);
        return response()->json(new HopCollectionResource($hopsPaginate));
    }

    public function store(HopRequest $request): JsonResponse
    {
        $hop = $this->service->create($request->user()->hops(), $request->validated());
        return response()->json(new HopResource($hop), Response::HTTP_CREATED);
    }

    public function show(Hop $hop): JsonResponse
    {
        return response()->json(new HopResource($hop));
    }

    public function update(HopRequest $request, Hop $hop): JsonResponse
    {
        $hop->update($request->validated());
        return response()->json(new HopResource($hop), Response::HTTP_CREATED);
    }

    public function destroy(Hop $hop): JsonResponse
    {
        $hop->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
