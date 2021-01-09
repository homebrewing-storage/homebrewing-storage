<?php

declare(strict_types=1);

namespace App\Http\Controllers\User\Credentials;

use App\Events\UserSettings\PasswordChangeEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\ChangePasswordService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function update(ChangePasswordRequest $request, ChangePasswordService $changePasswordService): JsonResponse
    {
        $changePasswordService->update($request);
        event(new PasswordChangeEvent("Password change"));

        return response()->json(Response::HTTP_CREATED);
    }
}
