<?php

declare(strict_types=1);

namespace App\Http\Controllers\User\Credentials;

use App\Http\Controllers\Contracts\ChangePasswordInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Services\User\ChangePasswordService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller implements ChangePasswordInterface
{
    public function update(ChangePasswordRequest $request, ChangePasswordService $service): JsonResponse
    {
        $user = $request->user();
        $password = $request->input('password_new');
        $service->update($user, $password);
        return response()->json(['message' => __('passwords.change')], Response::HTTP_CREATED);
    }
}
