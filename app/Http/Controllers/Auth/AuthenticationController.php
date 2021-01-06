<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Events\Auth\LogoutEvent;
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
        $data = $request->validated();
        $token = $service->register($data);
        return $this->responseJson(__('auth.register'), $token, Response::HTTP_CREATED);
    }

    /**
     * @throws UnauthorizedException
     */
    public function login(LoginUserRequest $request, LoginService $service): JsonResponse
    {
        $formCredentials = $request->validated();
        $token = $service->login($formCredentials);
        return $this->responseJson(__('auth.success'), $token);
    }

    public function logout(Request $request): void
    {
        $user = $request->user();
        event(new LogoutEvent($user));
        $user->currentAccessToken()->delete();
    }
}
