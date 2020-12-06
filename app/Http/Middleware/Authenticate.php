<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exceptions\Auth\UnauthorizedException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * @param $request
     * @param array $guards
     * @throws UnauthorizedException
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new UnauthorizedException();
    }
}
