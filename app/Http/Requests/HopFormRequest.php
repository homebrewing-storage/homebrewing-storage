<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HopFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
