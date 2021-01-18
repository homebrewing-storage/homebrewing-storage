<?php

namespace App\Http\Controllers\Contracts;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

interface SocialiteAuthInterface
{
    /**
     * @OA\Get(
     *     path="/login/github",
     *     operationId="redirectToGithub",
     *     tags={"Authentication"},
     *     summary="Allows user to log in",
     *     description="Logs in a user via an existing Github account",
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      )
     * )
     */
    public function redirectToGithub(): RedirectResponse;

    public function callbackToGithub(): JsonResponse;

    /**
     * @OA\Get(
     *     path="/login/facebook",
     *     operationId="redirectToFacebook",
     *     tags={"Authentication"},
     *     summary="Allows user to log in",
     *     description="Logs in a user via an existing Facebook account",
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      )
     * )
     */
    public function redirectToFacebook(): RedirectResponse;

    public function callbackToFacebook(): JsonResponse;
}
