<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\Auth\UnauthorizedException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationServices
{
    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $user = new User($data);
        $user->save();
        return $user;
    }

    /**
     * @param array $formCredentials
     * @return string
     * @throws UnauthorizedException
     */
    public function login(array $formCredentials): string
    {
        $user = User::query()->firstWhere('email', $formCredentials['email']);
        if (!$user || !Hash::check($formCredentials['password'], $user->password)) {
            throw new UnauthorizedException();
        }
        return $user->createToken($user->email)->plainTextToken;
    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
