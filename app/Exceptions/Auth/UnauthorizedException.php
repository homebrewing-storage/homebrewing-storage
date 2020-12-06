<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UnauthorizedException extends Exception
{
    protected $code = Response::HTTP_UNAUTHORIZED;
    protected $message = 'Unauthorized';
}
