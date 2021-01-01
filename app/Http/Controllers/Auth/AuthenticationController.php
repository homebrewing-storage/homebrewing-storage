<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Services\AuthenticationServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

    public function login(LoginUserRequest $request, AuthenticationServices $authenticationServices): JsonResponse
    {
        $formCredentials = $request->only('email', 'password');
        $token = $authenticationServices->login($formCredentials);

        $userId = $authenticationServices->getUserId($formCredentials['email']);

        Log::channel('database')->info("Successfully logged in.", [
            "Auth", "Log", $userId, " ", " ", "Success"
        ]);

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request, AuthenticationServices $authenticationServices): void
    {
        $userId = Auth::user()->id;
        Log::channel('database')->info("Successfully logged out.", [
            "Auth", "Log", $userId, " ", " ", "Success"
        ]);
        $authenticationServices->logout($request);
    }
}
