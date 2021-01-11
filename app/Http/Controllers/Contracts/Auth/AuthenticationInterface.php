<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface AuthenticationInterface
{
    /**
     * @OA\Post(
     *      path="/api/register",
     *      operationId="register",
     *      tags={"Authentication"},
     *      summary="Register an user with provided data",
     *      description="Registers a user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterUserRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      )
     *      )
     * @param RegisterUserRequest $request
     * @param RegisterService $service
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request, RegisterService $service): JsonResponse;

    /**
     * @OA\Post(
     *      path="/api/login",
     *      operationId="login",
     *      tags={"Authentication"},
     *      summary="Allows user to log in",
     *      description="Logs in a user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginUserRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      )
     *     )
     * @param LoginUserRequest $request
     * @param LoginService $service
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request, LoginService $service): JsonResponse;

    /**
     * @OA\Get(
     *      path="/api/logout",
     *      operationId="logout",
     *      tags={"Authentication"},
     *      summary="Allows user to log out",
     *      description="Logs out a user",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      )
     *     )
     * @param Request $request
     */
    public function logout(Request $request): void;
}
