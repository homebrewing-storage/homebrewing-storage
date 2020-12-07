<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\ResetPasswordServices;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
    public function forgotPassword(EmailRequest $request, ResetPasswordServices $resetPasswordServices): JsonResponse
    {
        $email = $request->only('email');
        $message = $resetPasswordServices->sendResetLink($email);
        return response()->json($message);
    }

    public function getToken($token): JsonResponse
    {
        return response()->json(['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request, ResetPasswordServices $resetPasswordServices): JsonResponse
    {
        $data = $request->only('email', 'password', 'password_confirmation', 'token');
        $message = $resetPasswordServices->resetPassword($data, $request);
        return response()->json($message);
    }
}
