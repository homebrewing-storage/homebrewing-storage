<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Contracts\EmailVerificationInterface;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller implements EmailVerificationInterface
{
    public function verify(): JsonResponse
    {
        return response()->json(['message' => __('auth.email')]);
    }

    public function accept(EmailVerificationRequest $request): JsonResponse
    {
        $request->fulfill();
        return response()->json(['message' => __('auth.accepted')]);
    }

    public function resend(Request $request): JsonResponse
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => __('auth.resend')]);
    }
}
