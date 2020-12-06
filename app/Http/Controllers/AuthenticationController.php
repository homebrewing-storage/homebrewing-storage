<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthenticationServices;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(RegisterUserRequest $request, AuthenticationServices $authenticationServices): JsonResponse
    {
        $data = $request->only('name', 'surname', 'email', 'password');
        $token = $authenticationServices->register($data);
        return response()->json([
            'message' => 'User registered. Sending The Verification Email',
            'token' => $token,
        ], 201);
    }

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

    public function verify(): JsonResponse
    {
        return response()->json(['message' => 'Check your mailbox']);
    }

    public function accept(EmailVerificationRequest $request): JsonResponse
    {
        $request->fulfill();
        return response()->json(['message' => 'Verify successful']);
    }

    public function resend(Request $request): JsonResponse
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'Resending The Verification Email']);
    }
}
