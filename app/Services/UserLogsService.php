<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserLogsService
{
    public function getUserLogs(User $user): LengthAwarePaginator
    {
        return $user->logs()->paginate(30);
    }
}
