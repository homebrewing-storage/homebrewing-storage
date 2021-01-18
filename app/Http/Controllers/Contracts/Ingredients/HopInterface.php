<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\Ingredients\HopRequest;
use App\Models\Hop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface HopInterface
{
    /**
     * @OA\Get(
     *     path="/api/hops",
     *     operationId="index",
     *     tags={"Hops"},
     *     summary="Get all paginated hops of a user",
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
     *     path="/api/hops",
     *     operationId="store",
     *     tags={"Hops"},
     *     summary="Add new hop",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/HopRequest")
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
     * @param HopRequest $request
     * @return JsonResponse
     */
    public function store(HopRequest $request): JsonResponse;

    /**
     * @OA\Get(
     *     path="/api/hops/{hop}",
     *     operationId="show",
     *     tags={"Hops"},
     *     summary="Show particular hop",
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
     * @param Hop $hop
     * @return JsonResponse
     */
    public function show(Hop $hop): JsonResponse;

    /**
     * @OA\Put(
     *     path="/api/hops/{hop}",
     *     operationId="update",
     *     tags={"Hops"},
     *     summary="Update hop",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/HopRequest")
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
     * @param HopRequest $request
     * @param Hop $hop
     * @return JsonResponse
     */
    public function update(HopRequest $request, Hop $hop): JsonResponse;

    /**
     * @OA\Delete(
     *     path="/api/hops/{hop}",
     *     operationId="destroy",
     *     tags={"Hops"},
     *     summary="Delete hop",
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
     * @param Hop $hop
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Hop $hop): JsonResponse;
}
