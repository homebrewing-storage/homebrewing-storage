<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\FermentableResource;
use App\Http\Requests\FermentableFormRequest;
use App\Models\Fermentable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FermentableController extends Controller
{
    // return collection of all fermentables
    public function index(): JsonResource
    {
        return FermentableResource::collection(Fermentable::all());
    }

    // create new fermentable
    public function store(FermentableFormRequest $request): JsonResponse
    {
        // validate incoming form
        $validated = $request->validated();
        // if form is correct, create new entry in DB
        // else redirect to the homepage and return 200
        Fermentable::create($validated);

        //return response with code 201(created)
        return response()->json($validated, 201);
    }

    // get specified fermentable
    public function show(Fermentable $fermentable): JsonResource
    {
        // return specified fermentable by passing an id
        return new FermentableResource($fermentable);
    }

    // update specified fermentable
    public function update(FermentableFormRequest $request, Fermentable $fermentable): JsonResponse
    {
        // check if new form is valid
        $validated = $request->validated();
        // if form is correct, update entry in DB
        // else redirect to the homepage and return 200
        $fermentable->update($validated);

        //return response with code 201(updated)
        return response()->json($fermentable, 201);
    }

    public function destroy(Fermentable $fermentable): JsonResponse
    {
        $fermentable->delete();

        return response()->json(null, 204);
    }
}
