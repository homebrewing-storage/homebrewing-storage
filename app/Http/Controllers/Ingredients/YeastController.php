<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ingredients\YeastFormRequest;
use App\Http\Resources\Yeast\YeastCollectionResource;
use App\Http\Resources\Yeast\YeastResource;
use App\Models\Yeast;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class YeastController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $user = Auth::user();
        $yeastsPaginate = $user->yeasts()->paginate($perPage, ['*'], 'page', $page);
        return response()->json(new YeastCollectionResource($yeastsPaginate));
    }

    public function store(YeastFormRequest $request): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $dataRequest = Arr::add($dataRequest, 'user_id', '1');
        $yeast = new Yeast($dataRequest);
        $yeast->save();
        return response()->json(new YeastResource($yeast), Response::HTTP_CREATED);
    }

    public function show(Yeast $yeast): JsonResponse
    {
        return response()->json(new YeastResource($yeast));
    }

    public function update(YeastFormRequest $request, Yeast $yeast): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $yeast->update($dataRequest);
        return response()->json(new YeastResource($yeast), Response::HTTP_CREATED);
    }

    public function destroy(Yeast $yeast): JsonResponse
    {
        $yeast->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('name', 'type_id', 'amount', 'expiration_date');
    }
}
