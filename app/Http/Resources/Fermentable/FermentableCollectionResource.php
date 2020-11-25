<?php

declare(strict_types=1);

namespace App\Http\Resources\Fermentable;

use App\Http\Resources\BaseCollectionResource;

class FermentableCollectionResource extends BaseCollectionResource
{
    public function toArray($request): array
    {
        return [
            'data' => FermentableResource::collection($this->collection),
            'pagination' => $this->pagination
        ];
    }
}
