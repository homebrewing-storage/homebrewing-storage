<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Services\User\ChangePasswordService;
use Illuminate\Http\JsonResponse;

interface ChangePasswordInterface
{
    /**
     * @OA\Post(
     *     path="/api/change-password",
     *     operationId="updatePassword",
     *     tags={"User Settings"},
     *     summary="Change user's password",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ChangePasswordRequest")
     * ),
     *     @OA\Response(
     *     response=201,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *      security={{ "apiAuth": {} }},
     *)
     *
     * @param ChangePasswordRequest $request
     * @param ChangePasswordService $service
     * @return JsonResponse
     */
    public function update(ChangePasswordRequest $request, ChangePasswordService $service): JsonResponse;
}
