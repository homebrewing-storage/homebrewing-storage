<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ingredients\ExtraFormRequest;
use App\Http\Resources\Extra\ExtraCollectionResource;
use App\Http\Resources\Extra\ExtraResource;
use App\Models\Extra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ExtraController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $user = Auth::user();
        $extrasPaginate = $user->extras()->paginate($perPage, ['*'], 'page', $page);
        return response()->json(new ExtraCollectionResource($extrasPaginate));
    }

    public function store(ExtraFormRequest $request): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $dataRequest = Arr::add($dataRequest, 'user_id', '1');
        $extra = new Extra($dataRequest);
        $extra->save();
        return response()->json(new ExtraResource($extra), Response::HTTP_CREATED);
    }

    public function show(Extra $extra): JsonResponse
    {
        return response()->json(new ExtraResource($extra));
    }

    public function update(ExtraFormRequest $request, Extra $extra): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $extra->update($dataRequest);
        return response()->json(new ExtraResource($extra), Response::HTTP_CREATED);
    }

    public function destroy(Extra $extra): JsonResponse
    {
        $extra->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('name', 'type_id', 'amount', 'expiration_date');
    }
}
