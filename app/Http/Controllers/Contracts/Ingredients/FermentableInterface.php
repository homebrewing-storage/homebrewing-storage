<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\Ingredients\FermentableRequest;
use App\Models\Fermentable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface FermentableInterface
{
    /**
     * @OA\Get(
     *     path="/api/fermentables",
     *     operationId="index",
     *     tags={"Fermentables"},
     *     summary="Get all paginated fermentables of a user",
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
     *     path="/api/fermentables",
     *     operationId="store",
     *     tags={"Fermentables"},
     *     summary="Add new fermentable",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/FermentableRequest")
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
     * @param FermentableRequest $request
     * @return JsonResponse
     */
    public function store(FermentableRequest $request): JsonResponse;

    /**
     * @OA\Get(
     *     path="/api/fermentables/{fermentable}",
     *     operationId="show",
     *     tags={"Fermentables"},
     *     summary="Get particular fermentable",
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
     * @param Fermentable $fermentable
     * @return JsonResponse
     */
    public function show(Fermentable $fermentable): JsonResponse;

    /**
     * @OA\Put(
     *     path="/api/fermentables/{fermentable}",
     *     operationId="update",
     *     tags={"Fermentables"},
     *     summary=" Update fermentable",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/FermentableRequest")
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
     * @param FermentableRequest $request
     * @param Fermentable $fermentable
     * @return JsonResponse
     */
    public function update(FermentableRequest $request, Fermentable $fermentable): JsonResponse;

    /**
     * @OA\Delete(
     *     path="/api/fermentables/{fermentable}",
     *     operationId="destroy",
     *     tags={"Fermentables"},
     *     summary="Delete fermentable",
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
     * @param Fermentable $fermentable
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Fermentable $fermentable): JsonResponse;

    public function types(): JsonResponse;
}
