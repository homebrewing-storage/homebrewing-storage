<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Events\Auth\LoginAuthEvent;
use App\Models\SocialAccount;
use App\Models\User;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class SocialiteAuthService extends BaseAuthService
{
    public function loginOrRegister(SocialiteUser $socialiteUser, string $nameOfSocialAccount): string
    {
        $user = User::query()->firstWhere('email', $socialiteUser->getEmail());
        $socialAccount = SocialAccount::query()->firstWhere('provider_id', $socialiteUser->getId());

        if ($user === null) {
            $user = $this->createUser($socialiteUser);
        }

        if ($socialAccount === null) {
            $this->createProvider($user, $socialiteUser, $nameOfSocialAccount);
        }
        event(new LoginAuthEvent($user));
        return $this->createToken($user);
    }

    private function createUser(SocialiteUser $socialiteUser): User
    {
        $username = $socialiteUser->getName();

        if (!$username) $username = $socialiteUser->getNickname();

        list($name, $surname) = explode(" ", "$username ");

        $user = new User([
            'name' => $name,
            'surname' => $surname,
            'email' => $socialiteUser->getEmail(),
            'email_verified_at' => now(),
        ]);
        $user->save();
        return $user;
    }

    private function createProvider(User $user, SocialiteUser $socialiteUser, string $nameOfSocialAccount): void
    {
        $user->socialAccounts()->create([
            'provider_id' => $socialiteUser->getId(),
            'name' => $nameOfSocialAccount,
        ]);
        $user->save();
    }
}
