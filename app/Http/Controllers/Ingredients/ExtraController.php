<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ingredients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ingredients\ExtraFormRequest;
use App\Http\Resources\Extra\ExtraCollectionResource;
use App\Http\Resources\Extra\ExtraResource;
use App\Http\Resources\TypeResource;
use App\Models\Extra;
use App\Models\ExtraType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ExtraController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:check,extra')->only(['show', 'update', 'destroy']);
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        $extrasPaginate = $request->user()->extras()->paginate($perPage, ['*'], 'page', $page);
        return response()->json(new ExtraCollectionResource($extrasPaginate));
    }

    public function store(ExtraFormRequest $request): JsonResponse
    {
        $dataRequest = $this->getDataRequest($request);
        $userId = $request->user()->id;
        $dataRequest = Arr::add($dataRequest, 'user_id', $userId);
        $extra = new Extra($dataRequest);

        Log::channel('database')->info("Successfully added new ingredient.", [
            "Auth", "Added ingredient", "Extra", $dataRequest['name'], "Success"
        ]);

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

        Log::channel('database')->info("Successfully updated new ingredient.", [
            "Auth", "Updated ingredient", "Extra", $dataRequest['name'], "Success"
        ]);

        return response()->json(new ExtraResource($extra), Response::HTTP_CREATED);
    }

    public function destroy(Extra $extra): JsonResponse
    {
        $extra->delete();

        Log::channel('database')->info("Successfully deleted ingredient.", [
            "Auth", "Deleted ingredient", "Extra", $extra['name'], "Success"
        ]);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function types(): JsonResponse
    {
        return response()->json(TypeResource::collection(ExtraType::all()));
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('name', 'type_id', 'amount', 'expiration_date');
    }
}
