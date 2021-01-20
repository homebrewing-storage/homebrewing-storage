<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Contracts\ResetPasswordInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\Auth\ResetPasswordServices;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller implements ResetPasswordInterface
{
    private ResetPasswordServices $service;

    public function __construct(ResetPasswordServices $service)
    {
        $this->service = $service;
    }

    public function forgotPassword(EmailRequest $request): JsonResponse
    {
        $message = $this->service->sendResetLink($request->validated());
        return response()->json($message);
    }

    public function getToken(string $token): JsonResponse
    {
        return response()->json(['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $message = $this->service->resetPassword($request->validated(), $request);
        return response()->json($message);
    }
}
