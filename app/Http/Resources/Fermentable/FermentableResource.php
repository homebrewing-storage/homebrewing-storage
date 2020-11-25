<?php

declare(strict_types=1);

namespace App\Http\Resources\Fermentable;

use App\Http\Resources\TypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FermentableResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'type' => new TypeResource($this->type),
            'yield' => $this->yield,
            'ebc' => $this->ebc,
            'amount' => $this->amount,
            'expiration_date' => $this->expiration_date,
        ];
    }
}
