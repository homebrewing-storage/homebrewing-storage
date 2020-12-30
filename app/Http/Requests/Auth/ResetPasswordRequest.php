<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class ResetPasswordRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|max:10|same:password_confirmation',
            'password_confirmation' => 'required',
        ];
    }
}
