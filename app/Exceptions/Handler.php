<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Auth\UnauthorizedException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e): Response
    {
        if ($e instanceof UnauthorizedException) {
            return response()->json([
                "message" => $e->getMessage()
            ], $e->getCode());
        }
        return parent::render($request, $e);
    }
}
