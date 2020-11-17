<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\HopResource;
use App\Http\Requests\HopFormRequest;
use App\Models\Hop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HopController extends Controller
{
    // return collection of all hops
    public function index(): JsonResponse
    {
        return response()->json(HopResource::collection(Hop::all()), 200);
    }

    // create new hop
    public function store(HopFormRequest $request): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
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
        return $request->only('name', 'type', 'amount', 'expiration_date');
    }
}
