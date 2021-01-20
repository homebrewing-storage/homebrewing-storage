<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\Ingredients\YeastRequest;
use App\Models\Yeast;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface YeastInterface
{
    /**
     * @OA\Get(
     *     path="/api/yeasts",
     *     operationId="index",
     *     tags={"Yeasts"},
     *     summary="Get all paginated yeasts of a user",
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
     *     path="/api/yeasts",
     *     operationId="store",
     *     tags={"Yeasts"},
     *     summary="Add new yeast",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/YeastRequest")
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
     * @param YeastRequest $request
     * @return JsonResponse
     */
    public function store(YeastRequest $request): JsonResponse;

    /**
     * @OA\Get(
     *     path="/api/yeasts/{yeast}",
     *     operationId="show",
     *     tags={"Yeasts"},
     *     summary="Show particular yeast",
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
     * @param Yeast $yeast
     * @return JsonResponse
     */
    public function show(Yeast $yeast): JsonResponse;

    /**
     * @OA\Put(
     *     path="/api/yeasts/{yeast}",
     *     operationId="store",
     *     tags={"Yeasts"},
     *     summary="Update yeast",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/YeastRequest")
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
     * @param YeastRequest $request
     * @param Yeast $yeast
     * @return JsonResponse
     */
    public function update(YeastRequest $request, Yeast $yeast): JsonResponse;

    /**
     * @OA\Delete(
     *     path="/api/yeasts/{yeast}",
     *     operationId="destroy",
     *     tags={"Yeasts"},
     *     summary="Delete yeast",
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
     * @param Yeast $yeast
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Yeast $yeast): JsonResponse;

    public function types(): JsonResponse;
}
