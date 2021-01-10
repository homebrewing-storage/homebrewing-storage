<?php

declare(strict_types=1);

namespace App\Http\Resources\Log;

use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'message' => $this->message,
            'date' => $this->datetime,
            'context' => $this->context,
        ];
    }
}
