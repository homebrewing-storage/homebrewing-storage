<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ingredients\YeastFormRequest;
use App\Http\Resources\TypeResource;
use App\Http\Resources\Yeast\YeastCollectionResource;
use App\Http\Resources\Yeast\YeastResource;
use App\Models\Yeast;
use App\Models\YeastType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class YeastController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:check,yeast')->only(['show', 'update', 'destroy']);
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $yeastsPaginate = $request->user()->yeasts()->paginate($perPage, ['*'], 'page', $page);
        return response()->json(new YeastCollectionResource($yeastsPaginate));
    }

    public function store(YeastFormRequest $request): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $userId = $request->user()->id;
        $dataRequest = Arr::add($dataRequest, 'user_id', $userId);
        $yeast = new Yeast($dataRequest);
        $yeast->save();

        Log::channel('database')->info("Successfully added new ingredient.", [
            "Ingredient", "Added ingredient", "Yeast", $dataRequest['name'], "Success"
        ]);

        return response()->json(new YeastResource($yeast), Response::HTTP_CREATED);
    }

    public function show(Yeast $yeast): JsonResponse
    {
        return response()->json(new YeastResource($yeast));
    }

    public function update(YeastFormRequest $request, Yeast $yeast): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $yeast->update($dataRequest);

        Log::channel('database')->info("Successfully updated new ingredient.", [
            "Ingredient", "Updated ingredient", "Yeast", $dataRequest['name'], "Success"
        ]);

        return response()->json(new YeastResource($yeast), Response::HTTP_CREATED);
    }

    public function destroy(Yeast $yeast): JsonResponse
    {
        $yeast->delete();

        Log::channel('database')->info("Successfully deleted ingredient.", [
            "Ingredient", "Deleted ingredient", "Yeast", $yeast['name'], "Success"
        ]);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function types(): JsonResponse
    {
        return response()->json(TypeResource::collection(YeastType::all()));
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('name', 'type_id', 'amount', 'expiration_date');
    }
}
