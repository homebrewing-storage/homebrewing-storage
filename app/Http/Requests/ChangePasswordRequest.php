<?php

declare(strict_types=1);

namespace App\Http\Requests;

class ChangePasswordRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|password:sanctum',
            'password_new' => 'required|string|min:6|max:10|same:password_confirmation',
            'password_confirmation' => 'required',
        ];
    }
}
