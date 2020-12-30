<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class RegisterUserRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:10|same:password_confirmation',
            'password_confirmation' => 'required',
        ];
    }
}
