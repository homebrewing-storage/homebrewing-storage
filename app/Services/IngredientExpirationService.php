<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\NotificationResource;
use App\Notifications\ExpiringIngredients;
use Illuminate\Support\Facades\Auth;

class IngredientExpirationService
{
    public function getNotifications()
    {
        $user = Auth::user();
        return NotificationResource::collection($user->notifications);
    }

    public function deleteNotification($notification)
    {
        return $notification->delete();
    }

    public function readNotifications($notification)
    {
        return $notification->update(['read_at' => now()]);
    }
}
