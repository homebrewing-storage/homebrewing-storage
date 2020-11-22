<?php

declare(strict_types=1);

namespace App\Http\Resources\Yeast;

use App\Http\Resources\BaseCollectionResource;

class YeastCollectionResource extends BaseCollectionResource
{
    public function toArray($request): array
    {
        return [
            'data' => YeastResource::collection($this->collection),
            'pagination' => $this->pagination
        ];
    }
}
