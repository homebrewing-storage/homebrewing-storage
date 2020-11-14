<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\YeastResource;
use App\Http\Requests\YeastFormRequest;
use App\Models\Yeast;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class YeastController extends Controller
{
    // return collection of all yeasts
    public function index(): JsonResource
    {
        return YeastResource::collection(Yeast::all());
    }

    // create new hop
    public function store(YeastFormRequest $request): JsonResponse
    {
        // validate incoming form
        $validated = $request->validated();
        // if form is correct, create new entry in DB
        // else redirect to the homepage and return 200
        Yeast::create($validated);

        //return response with code 201(created)
        return response()->json($validated, 201);
    }

    // get specified yeast
    public function show(Yeast $yeast): JsonResource
    {
        // return specified yeast by passing an id
        return new YeastResource($yeast);
    }

    // update specified yeast
    public function update(YeastFormRequest $request, Yeast $yeast): JsonResponse
    {
        // check if new form is valid
        $validated = $request->validated();
        // if form is correct, update entry in DB
        // else redirect to the homepage and return 200
        $yeast->update($validated);

        return response()->json($yeast, 201);
    }

    public function destroy(Yeast $yeast): JsonResponse
    {
        $yeast->delete();

        return response()->json(null, 204);
    }
}
