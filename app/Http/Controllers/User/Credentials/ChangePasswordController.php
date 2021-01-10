<?php

declare(strict_types=1);

namespace App\Http\Controllers\User\Credentials;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Services\User\ChangePasswordService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function update(ChangePasswordRequest $request, ChangePasswordService $service): JsonResponse
    {
        $user = $request->user();
        $password = $request->input('password_new');
        $service->update($user, $password);
        return response()->json(Response::HTTP_CREATED);
    }
}
