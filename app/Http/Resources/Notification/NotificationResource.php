<?php

declare(strict_types=1);

namespace App\Http\Resources\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid' => $this->id,
            'data' => $this->data,
        ];
    }
}
