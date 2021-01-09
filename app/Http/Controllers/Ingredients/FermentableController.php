<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ingredients\FermentableFormRequest;
use App\Http\Resources\Fermentable\FermentableCollectionResource;
use App\Http\Resources\Fermentable\FermentableResource;
use App\Http\Resources\TypeResource;
use App\Events\Ingredient\AddedEvent;
use App\Events\Ingredient\DeletedEvent;
use App\Events\Ingredient\UpdatedEvent;
use App\Models\Fermentable;
use App\Models\FermentableType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class FermentableController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:check,fermentable')->only(['show', 'update', 'destroy']);
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $fermentablesPaginate = $request->user()->fermentables()->paginate($perPage, ['*'], 'page', $page);
        return response()->json(new FermentableCollectionResource($fermentablesPaginate));
    }

    public function store(FermentableFormRequest $request): JsonResponse
    {
        $dataRequest = $request->validated();
        $userId = $request->user()->id;
        $dataRequest = Arr::add($dataRequest, 'user_id', $userId);
        $fermentable = new Fermentable($dataRequest);
        $fermentable->save();
        event(new AddedEvent($dataRequest['name'], "Fermentable"));

        return response()->json(new FermentableResource($fermentable), Response::HTTP_CREATED);
    }

    public function show(Fermentable $fermentable): JsonResponse
    {
        return response()->json(new FermentableResource($fermentable));
    }

    public function update(FermentableFormRequest $request, Fermentable $fermentable): JsonResponse
    {
        $dataRequest = $request->validated();
        $fermentable->update($dataRequest);
        event(new UpdatedEvent($dataRequest['name'], "Fermentable"));

        return response()->json(new FermentableResource($fermentable), Response::HTTP_CREATED);
    }

    public function destroy(Fermentable $fermentable): JsonResponse
    {
        $fermentable->delete();
        event(new DeletedEvent($fermentable['name'], "Fermentable"));

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function types(): JsonResponse
    {
        return response()->json(TypeResource::collection(FermentableType::all()));
    }
}
