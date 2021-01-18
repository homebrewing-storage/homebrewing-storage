<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseAuthController extends Controller
{
    protected function responseJson(string $message, string $token, int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'token' => $token,
        ], $status);
    }
}
