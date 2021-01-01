<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\Auth\UnauthorizedException;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;

class AuthenticationServices
{
    private Hasher $hash;

    public function __construct(Hasher $hash)
    {
        $this->hash = $hash;
    }

    public function register(array $data): string
    {
        $data['password'] = $this->hash->make($data['password']);
        $user = new User($data);
        $user->save();
        event(new Registered($user));
        return $this->createToken($user);
    }

    /**
     * @param array $formCredentials
     * @return string
     * @throws UnauthorizedException
     */
    public function login(array $formCredentials): string
    {
        $user = User::query()->firstWhere('email', $formCredentials['email']);
        if (!$user || !$this->hash->check($formCredentials['password'], $user->password)) {
            throw new UnauthorizedException();
        }
        return $this->createToken($user);
    }

    public function logout(Request $request): void
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
    }

    private function createToken(User $user): string
    {
        return $user->createToken($user->email)->plainTextToken;
    }

    public function getUserId(string $email): int
    {
        return User::query()->firstWhere('email', $email)->id;
    }
}
