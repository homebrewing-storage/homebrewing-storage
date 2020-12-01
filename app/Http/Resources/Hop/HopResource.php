<?php

declare(strict_types=1);

namespace App\Http\Resources\Hop;

use Illuminate\Http\Resources\Json\JsonResource;

class HopResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'amount' => $this->amount,
            'alpha_acid' => $this->alpha_acid,
            'expiration_date' => $this->expiration_date,
        ];
    }
}
