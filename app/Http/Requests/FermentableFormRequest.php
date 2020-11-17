<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FermentableFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'type' => 'required|string|min:3|max:255',
            'yield' => 'required|numeric|min:1|max:255',
            'ebc' => 'required|numeric|min:1|max:255',
            'amount' => 'required|numeric|min:1',
            'expiration_date' => 'required|date'
        ];
    }
}
