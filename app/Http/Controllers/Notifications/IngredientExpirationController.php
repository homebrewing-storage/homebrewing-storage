<?php

declare(strict_types=1);

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Models\IngredientExpiration;
use App\Services\Notifications\IngredientExpirationService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class IngredientExpirationController extends Controller
{
    private IngredientExpirationService $service;

    public function __construct(IngredientExpirationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $notifications = $this->service->getNotifications($request->user());
        return response()->json($notifications);
    }

    public function show(Request $request): JsonResponse
    {
        $unreadCount = $this->service->getUnread($request->user());
        return response()->json($unreadCount);
    }

    public function destroy(IngredientExpiration $notification): JsonResponse
    {
        $this->service->deleteNotification($notification);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function update(IngredientExpiration $notification): JsonResponse
    {
        $this->service->readNotifications($notification);
        return response()->json(null, Response::HTTP_CREATED);
    }
}
