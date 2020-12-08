<?php

declare(strict_types=1);

namespace App\Http\Resources\Extra;

use App\Http\Resources\BaseCollectionResource;

class ExtraCollectionResource extends BaseCollectionResource
{
    public function toArray($request): array
    {
        return [
            'data' => ExtraResource::collection($this->collection),
            'pagination' => $this->pagination
        ];
    }
}
