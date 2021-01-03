<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\Auth\UnauthorizedException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class UserLogsService
{
    /**
     * @throws UnauthorizedException
     */
    public function getUserLogs(): LengthAwarePaginator
    {
        $user = Auth::user();

        if(!$user)
        {
            throw new UnauthorizedException();
        } else {
            return $user->logs()->paginate(30);
        }
    }
}
