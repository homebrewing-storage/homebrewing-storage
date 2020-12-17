<?php

declare(strict_types=1);

namespace App\Http\Requests\Ingredients;

use App\Http\Requests\BaseRequest;

class ExtraFormRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'type_id' => 'required|numeric|exists:extra_types,id',
            'amount' => 'required|numeric|min:1',
            'expiration_date' => 'required|date'
        ];
    }
}
