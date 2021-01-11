<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\User\UserSettingsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface UserSettingsInterface
{
    /**
     * @OA\Get(
     *     path="/api/settings",
     *     operationId="showSettings",
     *     tags={"User Settings"},
     *     summary="Get user's settings",
     *     @OA\Response(
     *     response=200,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     * security={{ "apiAuth": {} }},
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse;

    /**
     * @OA\Put(
     *     path="/api/settings",
     *     operationId="updateSettings",
     *     tags={"User Settings"},
     *     summary="Update user's settings",
     * @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserSettingsRequest")
     *      ),
     * @OA\Response(
     *     response=201,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *      security={{ "apiAuth": {} }},
     * )
     * @param UserSettingsRequest $request
     * @return JsonResponse
     */
    public function update(UserSettingsRequest $request): JsonResponse;
}
