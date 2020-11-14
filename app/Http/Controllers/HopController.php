<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\HopResource;
use App\Http\Requests\HopFormRequest;
use App\Models\Hop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HopController extends Controller
{
    // return collection of all hops
    public function index(): JsonResource
    {
        return HopResource::collection(Hop::all());
    }

    // create new hop
    public function store(HopFormRequest $request): JsonResponse
    {
        // validate incoming form
        $validated = $request->validated();
        // if form is correct, create new entry in DB
        // else redirect to the homepage and return 200
        Hop::create($validated);

        //return response with code 201(created)
        return response()->json($validated, 201);
    }

    // get specified hop
    public function show(Hop $hop): JsonResource
    {
        // return specified hop by passing an id
        return new HopResource($hop);
    }

    // update specified hop
    public function update(HopFormRequest $request, Hop $hop): JsonResponse
    {
        // check if new form is valid
        $validated = $request->validated();
        // if form is correct, update entry in DB
        // else redirect to the homepage and return 200
        $hop->update($validated);

        //return response with code 201(updated)
        return response()->json($hop, 201);
    }

    public function destroy(Hop $hop): JsonResponse
    {
        $hop->delete();

        return response()->json(null, 204);
    }
}
