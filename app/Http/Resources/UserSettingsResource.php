<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSettingsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'reminder' => $this->reminder,
            'email' => $this->email,
            'hop' => $this->hop,
            'yeast' => $this->yeast,
            'fermentable' => $this->fermentable,
            'extra' => $this->extra,
        ];
    }
}
