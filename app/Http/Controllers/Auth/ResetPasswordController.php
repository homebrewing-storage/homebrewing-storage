<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\ResetPasswordServices;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
    private ResetPasswordServices $service;

    public function __construct(ResetPasswordServices $service)
    {
        $this->service = $service;
    }

    public function forgotPassword(EmailRequest $request): JsonResponse
    {
        $email = $request->validated();
        $message = $this->service->sendResetLink($email);
        return response()->json($message);
    }

    public function getToken(string $token): JsonResponse
    {
        return response()->json(['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $data = $request->validated();
        $message = $this->service->resetPassword($data, $request);
        return response()->json($message);
    }
}
