<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HopResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'amount' => $this->amount,
            'alpha_acid' => $this->alpha_acid,
            'expiration_date' => $this->expiration_date,
        ];
    }
}
