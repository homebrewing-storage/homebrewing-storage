<?php

declare(strict_types=1);

namespace App\Services\Notifications;

use App\Http\Resources\Notification\NotificationResource;
use App\Models\IngredientExpiration;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientExpirationService
{
    public function getAll(User $user): JsonResource
    {
        return NotificationResource::collection($user->notifications);
    }

    public function getUnread(User $user): JsonResource
    {
        return NotificationResource::collection($user->unreadNotifications);
    }

    public function getNumberOfUnread(User $user): int
    {
        return count(NotificationResource::collection($user->unreadNotifications));
    }

    public function delete(IngredientExpiration $notification): void
    {
        $notification->delete();
    }

    public function read(IngredientExpiration $notification): void
    {
        $notification->update(['read_at' => now()]);
    }
}
