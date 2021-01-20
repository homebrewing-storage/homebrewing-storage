<?php

namespace App\Http\Controllers\Contracts;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface EmailVerificationInterface
{
    /**
     * @OA\Get(
     *     path="/email/verify",
     *     operationId="verify",
     *     tags={"Email verification"},
     *     summary="After registering user must activate the account via provided email",
     * @OA\Response(
     *     response=200,
     *     description="Successful operation"
     * ),
     * @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *     security={{ "apiAuth": {} }},
     * )
     */
    public function verify(): JsonResponse;

    /**
     * @OA\Get(
     *     path="/email/verify/{id}/{hash}",
     *     operationId="accept",
     *     tags={"Email verification"},
     *     summary="User must activate the account via provided link sent to the email",
     * @OA\Parameter(
     *     name="id",
     *     description="user's id",
     *     in="path",
     *     @OA\Schema(
     *         type="string"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="hash",
     *     description="hashed, unique id",
     *     in="path",
     *     @OA\Schema(
     *         type="string"
     *     ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Successful operation"
     * ),
     * @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *     security={{ "apiAuth": {} }},
     * )
     * @param EmailVerificationRequest $request
     * @return JsonResponse
     */
    public function accept(EmailVerificationRequest $request): JsonResponse;

    /**
     * @OA\Post(
     *     path="/email/verification-notification",
     *     operationId="resend",
     *     tags={"Resend email verification"},
     *     summary="Resend activation link",
     * @OA\Response(
     *     response=200,
     *     description="Successful operation"
     * ),
     * @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *     security={{ "apiAuth": {} }},
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function resend(Request $request): JsonResponse;
}
