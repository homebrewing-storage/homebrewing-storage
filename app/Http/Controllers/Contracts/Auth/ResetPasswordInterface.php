<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\Auth\EmailRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\JsonResponse;

interface ResetPasswordInterface
{
    /**
     * @OA\Post(
     *     path="/api/forgot-password",
     *     operationId="forgotPassword",
     *     tags={"Password Reset"},
     *     summary="Send an email containing reset password link",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/EmailRequest")
     * ),
     *     @OA\Response(
     *     response=200,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     * )
     * @param EmailRequest $request
     * @return JsonResponse
     */
    public function forgotPassword(EmailRequest $request): JsonResponse;

    /**
     * @OA\Get(
     *     path="/api/reset-password/{token}",
     *     operationId="getToken",
     *     tags={"Password Reset"},
     *     summary="Get token sent to the email",
     *     @OA\Parameter(
     *          name="token",
     *          description="hashed token",
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          ),
     * ),
     *     @OA\Response(
     *     response=200,
     *     description="Successful operation"
     * ),
     * )
     */
    public function getToken(string $token): JsonResponse;

    /**
     * @OA\Post(
     *     path="/api/reset-password",
     *     operationId="resetPassword",
     *     tags={"Password Reset"},
     *     summary="Reset user's password after receiving an appriopriate token",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ResetPasswordRequest")
     * ),
     *
     *     @OA\Response(
     *     response=200,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     * )
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse;
}
