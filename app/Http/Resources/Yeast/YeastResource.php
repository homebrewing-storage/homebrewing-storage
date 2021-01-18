<?php

declare(strict_types=1);

namespace App\Http\Resources\Yeast;

use App\Http\Resources\IngredientType\TypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class YeastResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => new TypeResource($this->type),
            'amount' => $this->amount,
            'expiration_date' => $this->expiration_date->format('Y-m-d'),
        ];
    }
}
