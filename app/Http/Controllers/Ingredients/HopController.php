<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ingredients\HopFormRequest;
use App\Http\Resources\Hop\HopCollectionResource;
use App\Http\Resources\Hop\HopResource;
use App\Models\Hop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class HopController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:check,hop')->only(['show', 'update', 'destroy']);
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $hopsPaginate = $request->user()->hops()->paginate($perPage, ['*'], 'page', $page);
        return response()->json(new HopCollectionResource($hopsPaginate));
    }

    public function store(HopFormRequest $request): JsonResponse
    {
        $dataRequest = $request->validated();
        $userId = $request->user()->id;
        $dataRequest = Arr::add($dataRequest, 'user_id', $userId);
        $hop = new Hop($dataRequest);
        $hop->save();

        Log::channel('database')->info("Successfully added new ingredient.", [
            "Ingredient", "Added ingredient", "Hop", $dataRequest['name'], "Success"
        ]);

        return response()->json(new HopResource($hop), Response::HTTP_CREATED);
    }

    public function show(Hop $hop): JsonResponse
    {
        return response()->json(new HopResource($hop));
    }

    public function update(HopFormRequest $request, Hop $hop): JsonResponse
    {
        $dataRequest = $request->validated();
        $hop->update($dataRequest);

        Log::channel('database')->info("Successfully updated new ingredient.", [
            "Ingredient", "Updated ingredient", "Hop", $dataRequest['name'], "Success"
        ]);

        return response()->json(new HopResource($hop), Response::HTTP_CREATED);
    }

    public function destroy(Hop $hop): JsonResponse
    {
        $hop->delete();

        Log::channel('database')->info("Successfully deleted ingredient.", [
            "Ingredient", "Deleted ingredient", "Hop", $hop['name'], "Success"
        ]);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
