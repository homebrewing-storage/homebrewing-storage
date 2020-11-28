<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $user = new User($request->only(
            'name', 'surname', 'email', 'password', 'password_confirmation'
        ));

        $user->fill(
            ['password' => Hash::make($user->password)]
        )->save();
        return response()->json($user, 201);
    }

    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user)
        {
            $remember = $request->get('rememberMe');

            $formCredentials = $request->only('email', 'password');

            if(Auth::attempt($formCredentials, $remember))
            {
                $token = $user->createToken($user->email)->plainTextToken;
                return response()->json($token, 200);
            }
        }
        return response()->json('Incorrect credentials.', 400);
    }

    public function logout()
    {
        Auth::logout();
    }
}
