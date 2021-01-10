<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Events\Auth\LogoutAuthEvent;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends BaseAuthController
{
    public function register(RegisterUserRequest $request, RegisterService $service): JsonResponse
    {
        $token = $service->register($request->validated());
        return $this->responseJson(__('auth.register'), $token, Response::HTTP_CREATED);
    }

    /**
     * @throws UnauthorizedException
     */
    public function login(LoginUserRequest $request, LoginService $service): JsonResponse
    {
        $token = $service->login($request->validated());
        return $this->responseJson(__('auth.success'), $token);
    }

    public function logout(Request $request): void
    {
        $user = $request->user();
        event(new LogoutAuthEvent($user));
        $user->currentAccessToken()->delete();
    }
}
