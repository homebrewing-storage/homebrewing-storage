<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Events\UserSettings\PasswordChangeEvent;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

class ChangePasswordService
{
    private Hasher $hash;

    public function __construct(Hasher $hash)
    {
        $this->hash = $hash;
    }

    public function update(User $user, string $password): void
    {
        $user->update(['password' => $this->hash->make($password)]);
        event(new PasswordChangeEvent("Password change"));
    }
}
