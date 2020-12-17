<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\NotificationResource;
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

    public function deleteNotification($notification): void
    {
        $notification->delete();
    }

    public function readNotifications($notification): bool
    {
        return $notification->update(['read_at' => now()]);
    }
}
