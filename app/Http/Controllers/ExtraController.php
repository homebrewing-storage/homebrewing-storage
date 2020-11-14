<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ExtraResource;
use App\Http\Requests\ExtraFormRequest;
use App\Models\Extra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExtraController extends Controller
{
    // return collection of all extras
    public function index(): JsonResource
    {
        return ExtraResource::collection(Extra::all());
    }

    // create new extra
    public function store(ExtraFormRequest $request): JsonResponse
    {
        // validate incoming form
        $validated = $request->validated();
        // if form is correct, create new entry in DB
        // else redirect to the homepage and return 200
        Extra::create($validated);

        //return response with code 201(created)
        return response()->json($validated, 201);
    }

    // get specified hop
    public function show(Extra $extra): JsonResource
    {
        // return specified extra by passing an id
        return new ExtraResource($extra);
    }

    // update specified extra
    public function update(ExtraFormRequest $request, Extra $extra): JsonResponse
    {
        // check if new form is valid
        $validated = $request->validated();
        // if form is correct, update entry in DB
        // else redirect to the homepage and return 200
        $extra->update($validated);

        //return response with code 201(updated)
        return response()->json($extra, 201);
    }

    public function destroy(Extra $extra): JsonResponse
    {
        $extra->delete();

        return response()->json(null, 204);
    }
}
