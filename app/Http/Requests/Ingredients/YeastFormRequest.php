<?php

namespace App\Http\Requests\Ingredients;

use Illuminate\Foundation\Http\FormRequest;

class YeastFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'type_id' => 'required|numeric|exists:yeast_types,id',
            'amount' => 'required|numeric|min:1',
            'expiration_date' => 'required|date'
        ];
    }
}
