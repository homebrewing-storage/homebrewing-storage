<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSettingsFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reminder' => 'required|numeric|between:1,14',
            'email' => 'required|boolean',
            'hop' => 'required|boolean',
            'yeast' => 'required|boolean',
            'fermentable' => 'required|boolean',
            'extra' => 'required|boolean',
        ];
    }
}
