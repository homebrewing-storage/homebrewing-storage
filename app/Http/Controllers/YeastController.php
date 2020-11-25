<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\YeastFormRequest;
use App\Http\Resources\Yeast\YeastCollectionResource;
use App\Http\Resources\Yeast\YeastResource;
use App\Models\User;
use App\Models\Yeast;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class YeastController extends Controller
{
    // return collection of all yeasts
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $user = User::query()->findOrFail(1);
        $yeastsPaginate = $user->hops()->paginate($perPage, ['*'], 'page', $page);
        return response()->json(new YeastCollectionResource($yeastsPaginate), 200);
    }

    // create new hop
    public function store(YeastFormRequest $request): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $dataRequest = Arr::add($dataRequest, 'user_id', '1');
        $yeast = new Yeast($dataRequest);   //create yeast
        $yeast->save();

        //return response with code 201(created)
        return response()->json(new YeastResource($yeast), 201);
    }

    // get specified yeast
    public function show(Yeast $yeast): JsonResponse
    {
        // return specified yeast by passing an id
        return response()->json(new YeastResource($yeast), 200);
    }

    // update specified yeast
    public function update(YeastFormRequest $request, Yeast $yeast): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $yeast->update($dataRequest);   //update yeast

        return response()->json(new YeastResource($yeast), 201);
    }

    public function destroy(Yeast $yeast): JsonResponse
    {
        $yeast->delete();
        return response()->json(null, 204);
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('name', 'type_id', 'amount', 'expiration_date');
    }
}
