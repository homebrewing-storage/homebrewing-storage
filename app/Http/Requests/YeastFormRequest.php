<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YeastFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'type' => 'required',
            'amount' => 'required|min:1',
            'expiration_date' => 'required|date'
        ];
    }
}
