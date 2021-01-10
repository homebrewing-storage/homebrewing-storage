<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Events\Auth\LoginAuthEvent;
use App\Exceptions\Auth\UnauthorizedException;
use App\Models\User;

class LoginService extends BaseAuthService
{
    /**
     * @throws UnauthorizedException
     */
    public function login(array $formCredentials): string
    {
        $user = User::query()->firstWhere('email', $formCredentials['email']);
        if (!$user || !$this->hash->check($formCredentials['password'], $user->password)) {
            throw new UnauthorizedException();
        }
        event(new LoginAuthEvent($user));
        return $this->createToken($user);
    }
}
