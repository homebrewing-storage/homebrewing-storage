<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthenticationServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(RegisterUserRequest $request, AuthenticationServices $authenticationServices): JsonResponse
    {
        $data = $request->only('name', 'surname', 'email', 'password');
        $user = $authenticationServices->register($data);
        return response()->json(['user' => $user], 201);
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
}
