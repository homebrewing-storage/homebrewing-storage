<?php

declare(strict_types=1);

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Models\IngredientExpiration;
use App\Services\IngredientExpirationService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class IngredientExpirationController extends Controller
{
    public function index(IngredientExpirationService $expirationService): JsonResponse
    {
        $notifications = $expirationService->getNotifications();
        return response()->json($notifications);
    }

    public function show(IngredientExpirationService $expirationService): JsonResponse
    {
        $unreadCount = $expirationService->getUnread();
        return response()->json($unreadCount);
    }

    public function destroy(IngredientExpiration $notification, IngredientExpirationService $expirationService): JsonResponse
    {
        $expirationService->deleteNotification($notification);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function update(IngredientExpiration $notification, IngredientExpirationService $expirationService): JsonResponse
    {
        $read = $expirationService->readNotifications($notification);

        return response()->json($read, Response::HTTP_CREATED);
    }
}
