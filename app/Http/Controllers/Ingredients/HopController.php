<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ingredients\HopFormRequest;
use App\Http\Resources\Hop\HopCollectionResource;
use App\Http\Resources\Hop\HopResource;
use App\Events\Ingredient\AddedEvent;
use App\Events\Ingredient\DeletedEvent;
use App\Events\Ingredient\UpdatedEvent;
use App\Models\Hop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $dataRequest['user_id'] = $userId;
        $hop = new Hop($dataRequest);
        $hop->save();
        event(new AddedEvent($dataRequest['name'], "Hop"));

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
        event(new UpdatedEvent($dataRequest['name'], "Hop"));

        return response()->json(new HopResource($hop), Response::HTTP_CREATED);
    }

    public function destroy(Hop $hop): JsonResponse
    {
        $hop->delete();
        event(new DeletedEvent($hop['name'], "Hop"));

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
