<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ExtraFormRequest;
use App\Http\Resources\Extra\ExtraCollectionResource;
use App\Http\Resources\Extra\ExtraResource;
use App\Models\Extra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ExtraController extends Controller
{
    // return collection of all extras
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $extrasPaginate = Extra::query()->paginate($perPage, ['*'], 'page', $page);
        return response()->json(new ExtraCollectionResource($extrasPaginate), 200);
    }

    // create new extra
    public function store(ExtraFormRequest $request): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $dataRequest = Arr::add($dataRequest, 'user_id', '1');
        $extra = new Extra($dataRequest);   //create Extra
        $extra->save();

        //return response with code 201(created)
        return response()->json(new ExtraResource($extra), 201);
    }

    // get specified hop
    public function show(Extra $extra): JsonResponse
    {
        // return specified extra by passing an id
        return response()->json(new ExtraResource($extra), 200);
    }

    // update specified extra
    public function update(ExtraFormRequest $request, Extra $extra): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $extra->update($dataRequest);   //update Extra

        //return response with code 201(updated)
        return response()->json(new ExtraResource($extra), 201);
    }

    public function destroy(Extra $extra): JsonResponse
    {
        $extra->delete();
        return response()->json(null, 204);
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('name', 'type_id', 'amount', 'expiration_date');
    }
}
