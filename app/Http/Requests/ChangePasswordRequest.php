<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|password:sanctum',
            'password_new' => 'required|string|min:6|max:10|same:password_confirmation',
            'password_confirmation' => 'required',
        ];
    }
}
