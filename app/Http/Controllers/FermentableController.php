<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\FermentableResource;
use App\Http\Requests\FermentableFormRequest;
use App\Models\Fermentable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FermentableController extends Controller
{
    // return collection of all fermentables
    public function index(): JsonResponse
    {
        return response()->json(FermentableResource::collection(Fermentable::all()), 200);
    }

    // create new fermentable
    public function store(FermentableFormRequest $request): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $dataRequest = Arr::add($dataRequest, 'user_id', '1');

        $fermentable = new Fermentable($dataRequest);   //create fermentable
        $fermentable->save();

        //return response with code 201(created)
        return response()->json(new FermentableResource($fermentable), 201);
    }

    // get specified fermentable
    public function show(Fermentable $fermentable): JsonResponse
    {
        // return specified fermentable by passing an id
        return response()->json(new FermentableResource($fermentable), 200);
    }

    // update specified fermentable
    public function update(FermentableFormRequest $request, Fermentable $fermentable): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $fermentable->update($dataRequest); //update fermentable

        //return response with code 201(updated)
        return response()->json(new FermentableResource($fermentable), 201);
    }

    public function destroy(Fermentable $fermentable): JsonResponse
    {
        $fermentable->delete();
        return response()->json(null, 204);
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('name', 'type_id', 'yield', 'ebc', 'amount', 'expiration_date');
    }
}
