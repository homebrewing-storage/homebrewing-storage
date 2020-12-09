<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ingredients\FermentableFormRequest;
use App\Http\Resources\Fermentable\FermentableCollectionResource;
use App\Http\Resources\Fermentable\FermentableResource;
use App\Models\Fermentable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FermentableController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $user = Auth::user();
        $fermentablesPaginate = $user->fermentables()->paginate($perPage, ['*'], 'page', $page);
        return response()->json(new FermentableCollectionResource($fermentablesPaginate));
    }

    public function store(FermentableFormRequest $request): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $dataRequest = Arr::add($dataRequest, 'user_id', '1');
        $fermentable = new Fermentable($dataRequest);
        $fermentable->save();
        return response()->json(new FermentableResource($fermentable), Response::HTTP_CREATED);
    }

    public function show(Fermentable $fermentable): JsonResponse
    {
        return response()->json(new FermentableResource($fermentable));
    }

    public function update(FermentableFormRequest $request, Fermentable $fermentable): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $fermentable->update($dataRequest);
        return response()->json(new FermentableResource($fermentable), Response::HTTP_CREATED);
    }

    public function destroy(Fermentable $fermentable): JsonResponse
    {
        $fermentable->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('name', 'type_id', 'yield', 'ebc', 'amount', 'expiration_date');
    }
}
