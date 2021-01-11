<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\Ingredients\ExtraRequest;
use App\Models\Extra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface ExtraInterface
{
    /**
     * @OA\Get(
     *     path="/api/extras",
     *     operationId="index",
     *     tags={"Extras"},
     *     summary="Get all paginated extras of a user",
     *     @OA\Response(
     *     response=200,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *      security={{ "apiAuth": {} }},
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse;

    /**
     * @OA\Post(
     *     path="/api/extras",
     *     operationId="store",
     *     tags={"Extras"},
     *     summary="Add new extra",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ExtraRequest")
     *      ),
     *     @OA\Response(
     *     response=201,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *      security={{ "apiAuth": {} }},
     * )
     * @param ExtraRequest $request
     * @return JsonResponse
     */
    public function store(ExtraRequest $request): JsonResponse;

    /**
     * @OA\Get(
     *     path="/api/extras/{extras}",
     *     operationId="show",
     *     tags={"Extras"},
     *     summary="Show particular extra",
     *     @OA\Response(
     *     response=200,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *      security={{ "apiAuth": {} }},
     * )
     * @param Extra $extra
     * @return JsonResponse
     */
    public function show(Extra $extra): JsonResponse;

    /**
     * @OA\Put(
     *     path="/api/extras/{extra}",
     *     operationId="update",
     *     tags={"Extras"},
     *     summary="Update extra",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ExtraRequest")
     *      ),
     *     @OA\Response(
     *     response=201,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *      security={{ "apiAuth": {} }},
     * )
     * @param ExtraRequest $request
     * @param Extra $extra
     * @return JsonResponse
     */
    public function update(ExtraRequest $request, Extra $extra): JsonResponse;

    /**
     * @OA\Delete(
     *     path="/api/extras/{extra}",
     *     operationId="destroy",
     *     tags={"Extras"},
     *     summary="Delete extra",
     *     @OA\Response(
     *     response=204,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *      security={{ "apiAuth": {} }},
     * )
     *
     * @param Extra $extra
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Extra $extra): JsonResponse;

    public function types(): JsonResponse;
}
