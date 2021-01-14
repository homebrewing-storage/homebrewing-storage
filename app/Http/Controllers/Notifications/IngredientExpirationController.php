<?php

declare(strict_types=1);

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Contracts\IngredientExpirationInterface;
use App\Http\Controllers\Controller;
use App\Models\IngredientExpiration;
use App\Services\Notifications\IngredientExpirationService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class IngredientExpirationController extends Controller implements IngredientExpirationInterface
{
    private IngredientExpirationService $service;

    public function __construct(IngredientExpirationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $notifications = $this->service->getAll($request->user());
        return response()->json($notifications);
    }

    public function getUnread(Request $request): JsonResponse
    {
        $notifications = $this->service->getUnread($request->user());
        return response()->json($notifications);
    }

    public function getNumberOfUnread(Request $request): JsonResponse
    {
        $unreadCount = $this->service->getNumberOfUnread($request->user());
        return response()->json(['number' => $unreadCount]);
    }

    public function destroy(IngredientExpiration $notification): JsonResponse
    {
        $this->service->delete($notification);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function read(IngredientExpiration $notification): JsonResponse
    {
        $this->service->read($notification);
        return response()->json(null, Response::HTTP_CREATED);
    }
}
