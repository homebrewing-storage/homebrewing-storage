<?php

declare(strict_types=1);

namespace App\Http\Requests\Ingredients;

use App\Http\Requests\BaseRequest;

class HopFormRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'alpha_acid' => 'required|numeric|min:1|max:3',
            'amount' => 'required|numeric|min:1',
            'expiration_date' => 'required|date'
        ];
    }
}
