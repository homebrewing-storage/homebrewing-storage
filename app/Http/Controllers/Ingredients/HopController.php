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
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HopController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $user = Auth::user();
        $hopsPaginate = $user->hops()->paginate($perPage, ['*'], 'page', $page);
        return response()->json(new HopCollectionResource($hopsPaginate));
    }

    public function store(HopFormRequest $request): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $dataRequest = Arr::add($dataRequest, 'user_id', '1');
        $hop = new Hop($dataRequest);
        $hop->save();
        return response()->json(new HopResource($hop), Response::HTTP_CREATED);
    }

    public function show(Hop $hop): JsonResponse
    {
        return response()->json(new HopResource($hop));
    }

    public function update(HopFormRequest $request, Hop $hop): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $hop->update($dataRequest);
        return response()->json(new HopResource($hop), Response::HTTP_CREATED);
    }

    public function destroy(Hop $hop): JsonResponse
    {
        $hop->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('name', 'amount', 'alpha_acid', 'expiration_date');
    }
}
