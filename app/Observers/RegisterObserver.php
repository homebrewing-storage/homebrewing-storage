<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;

class RegisterObserver
{
    public function created(User $user): void
    {
        $user->userSettings()->create();
    }
}
