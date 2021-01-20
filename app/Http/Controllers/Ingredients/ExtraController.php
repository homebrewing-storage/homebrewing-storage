<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Contracts\ExtraInterface;
use App\Http\Requests\Ingredients\ExtraRequest;
use App\Http\Resources\Extra\ExtraCollectionResource;
use App\Http\Resources\Extra\ExtraResource;
use App\Http\Resources\IngredientType\TypeResource;
use App\Models\Extra;
use App\Models\ExtraType;
use App\Services\Ingredient\IngredientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExtraController extends BaseIngredientController implements ExtraInterface
{
    public function __construct(IngredientService $service)
    {
        parent::__construct($service);
        $this->middleware('can:check,extra')->only(['show', 'update', 'destroy']);
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $relation = $request->user()->extras();
        $extrasPaginate = $this->service->paginate($relation, (int)$perPage, (int)$page);
        return response()->json(new ExtraCollectionResource($extrasPaginate));
    }

    public function store(ExtraRequest $request): JsonResponse
    {
        $extra = $this->service->create($request->user()->extras(), $request->validated());
        return response()->json(new ExtraResource($extra), Response::HTTP_CREATED);
    }

    public function show(Extra $extra): JsonResponse
    {
        return response()->json(new ExtraResource($extra));
    }

    public function update(ExtraRequest $request, Extra $extra): JsonResponse
    {
        $this->service->update($extra, $request->validated());
        return response()->json(new ExtraResource($extra), Response::HTTP_CREATED);
    }

    public function destroy(Extra $extra): JsonResponse
    {
        $this->service->destroy($extra);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function types(): JsonResponse
    {
        return response()->json(TypeResource::collection(ExtraType::all()));
    }
}
