<?php

declare(strict_types=1);

namespace App\Http\Resources\Hop;

use App\Http\Resources\BaseCollectionResource;

class HopCollectionResource extends BaseCollectionResource
{
    public function toArray($request): array
    {
        return [
            'data' => HopResource::collection($this->collection),
            'pagination' => $this->pagination
        ];
    }
}
