<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Events\Auth\LoginEvent;
use App\Exceptions\Auth\UnauthorizedException;
use App\Models\User;

class LoginService extends BaseAuthService
{
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
        event(new LoginEvent($user));
        return $this->createToken($user);
    }
}
