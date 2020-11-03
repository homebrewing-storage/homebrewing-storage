<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class YeastResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'amount' => $this->amount,
            'expiration_date' => $this->expiration_date,
        ];
    }
}