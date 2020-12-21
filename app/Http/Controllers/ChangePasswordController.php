<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Services\ChangePasswordService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function update(ChangePasswordRequest $request, ChangePasswordService $changePasswordService): JsonResponse
    {
        $changePasswordService->update($request);

        Log::channel('database')->info("Successfully updated password.", [
            "Auth", "Credential change", "Password", "Success"
        ]);

        return response()->json(Response::HTTP_CREATED);
    }
}
