<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Services\AuthenticationServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    public function register(RegisterUserRequest $request, AuthenticationServices $authenticationServices): JsonResponse
    {
        $data = $request->only('name', 'surname', 'email', 'password');
        $token = $authenticationServices->register($data);
        return response()->json([
            'message' => 'User registered. Sending The Verification Email',
            'token' => $token,
        ], Response::HTTP_CREATED);
    }

    /**
     * @param LoginUserRequest $request
     * @param AuthenticationServices $authenticationServices
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function login(LoginUserRequest $request, AuthenticationServices $authenticationServices): JsonResponse
    {
        $formCredentials = $request->only('email', 'password');
        $token = $authenticationServices->login($formCredentials);
        return response()->json(['token' => $token]);
    }

    public function logout(Request $request, AuthenticationServices $authenticationServices): void
    {
        $authenticationServices->logout($request);
    }

    public function redirectGithub(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    public function callbackGithub(AuthenticationServices $authenticationServices): JsonResponse
    {
        $user = Socialite::driver('github')->stateless()->user();
        $token = $authenticationServices->loginSocialMedia($user);
        return response()->json(['token' => $token]);
    }
}
