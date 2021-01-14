<?php

declare(strict_types=1);

namespace App\Services\Logs;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserLogsService
{
    public function getUserLogs(User $user): Collection
    {
        return $user->logs;
    }
}
