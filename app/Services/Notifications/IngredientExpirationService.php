<?php

declare(strict_types=1);

namespace App\Services\Notifications;

use App\Http\Resources\Notification\NotificationResource;
use App\Models\IngredientExpiration;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientExpirationService
{
    public function getNotifications(User $user): JsonResource
    {
        return NotificationResource::collection($user->notifications);
    }

    public function getUnread(User $user): int
    {
        return count(NotificationResource::collection($user->unreadNotifications));
    }

    public function deleteNotification(IngredientExpiration $notification): void
    {
        $notification->delete();
    }

    public function readNotifications(IngredientExpiration $notification): void
    {
        $notification->update(['read_at' => now()]);
    }
}
