<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FermentableResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'type_id' => new FermentableTypeResource($this->type),
            'yield' => $this->yield,
            'ebc' => $this->ebc,
            'amount' => $this->amount,
            'expiration_date' => $this->expiration_date,
        ];
    }
}
