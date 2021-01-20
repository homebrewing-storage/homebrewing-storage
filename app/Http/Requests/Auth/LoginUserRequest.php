<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

/**
 * @OA\Schema(
 *      title="Login user request",
 *      description="Logs in a user request body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */
class LoginUserRequest extends BaseRequest
{
    /**
     * @OA\Property(
     *     property="email",
     *     title="User's email",
     *     description="Email of the existing user",
     *     type="string",
     *     example="bob.ross@example.com"
     * ),
     * @OA\Property(
     *     property="password",
     *     title="User's password",
     *     description="Password of the existing user",
     *     type="string",
     *     example="Bobross123"
     * ),
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:5|max:10',
        ];
    }
}
