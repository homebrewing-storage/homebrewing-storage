<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\IngredientExpiration;
use App\Services\IngredientExpirationService;
use Illuminate\Http\JsonResponse;

class IngredientExpirationController extends Controller
{
    public function index(IngredientExpirationService $expirationService): JsonResponse
    {
        $notifications = $expirationService->getNotifications();
        return response()->json($notifications, 200);
    }

    public function destroy(IngredientExpiration $notification, IngredientExpirationService $expirationService): JsonResponse
    {
        $deleted = $expirationService->deleteNotification($notification);
        return response()->json($deleted, 204);
    }

    public function update(IngredientExpiration $notification, IngredientExpirationService $expirationService): JsonResponse
    {
        $read = $expirationService->readNotifications($notification);

        return response()->json($read, 201);
    }
}
