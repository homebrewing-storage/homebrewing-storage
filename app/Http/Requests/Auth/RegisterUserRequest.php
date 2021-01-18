<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

/**
 * @OA\Schema(
 *      title="Register user request",
 *      description="Register a user using request body data",
 *      type="object",
 *      required={"name", "surname", "email", "password", "password_confirmation",}
 * )
 */
class RegisterUserRequest extends BaseRequest
{
    public function rules(): array
    {
        /**
         * @OA\Property(
         *     property="name",
         *     title="User's name",
         *     description="Name of the new user",
         *     type="string",
         *     example="Bob"
         * ),
         * @OA\Property(
         *     property="surname",
         *     title="User's surname",
         *     description="Surname of the new user",
         *     type="string",
         *     example="Ross"
         * ),
         * @OA\Property(
         *     property="email",
         *     title="User's email",
         *     description="Email address of the new user",
         *     type="string",
         *     example="bob.ross@example.com"
         * ),
         * @OA\Property(
         *     property="password",
         *     title="User's password",
         *     description="Password of the new user",
         *     type="string",
         *     example="Bobross123"
         * ),
         * @OA\Property(
         *     property="password_confirmation",
         *     title="User's password confirmation",
         *     description="Password confirmation of the new user",
         *     type="string",
         *     example="Bobross123"
         * ),
         * @return array
         */
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:10|same:password_confirmation',
            'password_confirmation' => 'required',
        ];
    }
}
