<?php

declare(strict_types=1);

namespace App\Http\Resources\Yeast;

use Illuminate\Http\Resources\Json\JsonResource;

class YeastResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type->name,
            'amount' => $this->amount,
            'expiration_date' => $this->expiration_date,
        ];
    }
}
