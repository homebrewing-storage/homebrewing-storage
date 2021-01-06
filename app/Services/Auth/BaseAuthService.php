<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

abstract class BaseAuthService
{
    protected Hasher $hash;

    public function __construct(Hasher $hash)
    {
        $this->hash = $hash;
    }

    protected function createToken(User $user): string
    {
        return $user->createToken($user->email)->plainTextToken;
    }
}
