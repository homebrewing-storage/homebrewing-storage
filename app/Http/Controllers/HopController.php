<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\HopFormRequest;
use App\Http\Resources\Hop\HopCollectionResource;
use App\Http\Resources\Hop\HopResource;
use App\Models\Hop;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HopController extends Controller
{
    // return collection of all hops
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $user = User::query()->findOrFail(1);
        $hopsPaginate = $user->hops()->paginate($perPage, ['*'], 'page', $page);
        return response()->json(new HopCollectionResource($hopsPaginate), 200);
    }

    // create new hop
    public function store(HopFormRequest $request): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $dataRequest = Arr::add($dataRequest, 'user_id', '1');

        $hop = new Hop($dataRequest);   //create Hop
        $hop->save();

        //return response with code 201(created)
        return response()->json(new HopResource($hop), 201);
    }

    // get specified hop
    public function show(Hop $hop): JsonResponse
    {
        // return specified hop by passing an id
        return response()->json(new HopResource($hop), 200);
    }

    // update specified hop
    public function update(HopFormRequest $request, Hop $hop): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $hop->update($dataRequest); //update hop

        //return response with code 201(updated)
        return response()->json(new HopResource($hop), 201);
    }

    public function destroy(Hop $hop): JsonResponse
    {
        $hop->delete();
        return response()->json(null, 204);
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('name', 'amount', 'alpha_acid', 'expiration_date');
    }
}
