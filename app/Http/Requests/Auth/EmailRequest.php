<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class EmailRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email'
        ];
    }
}
