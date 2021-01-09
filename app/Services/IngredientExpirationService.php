<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\NotificationResource;
use App\Models\IngredientExpiration;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class IngredientExpirationService
{
    public function getNotifications(): JsonResource
    {
        $user = Auth::user();
        return NotificationResource::collection($user->notifications);
    }

    public function getUnread(): int
    {
        $user = Auth::user();
        return count(NotificationResource::collection($user->unreadNotifications));
    }

    public function deleteNotification(IngredientExpiration $notification): void
    {
        $notification->delete();
    }

    public function readNotifications(IngredientExpiration $notification): bool
    {
        return $notification->update(['read_at' => now()]);
    }
}
