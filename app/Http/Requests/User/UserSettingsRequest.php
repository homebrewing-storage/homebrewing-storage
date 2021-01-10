<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UserSettingsRequest extends BaseRequest
{
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
