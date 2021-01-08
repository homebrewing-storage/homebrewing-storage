<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterService extends BaseAuthService
{
    public function register(array $data): string
    {
        $data['password'] = $this->hash->make($data['password']);
        $user = new User($data);
        $user->save();
        $user->userSettings()->create();
        event(new Registered($user));
        return $this->createToken($user);
    }
}
