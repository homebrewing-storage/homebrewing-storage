<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

/**
 * @OA\Schema(
 *      title="Password reset request",
 *      description="Reset user's password using request body data",
 *      type="object",
 *      required={"token", "email", "password", "password_confirmation",}
 * )
 */
class ResetPasswordRequest extends BaseRequest
{
    /**
     * @OA\Property(
     *     property="token",
     *     title="User's token",
     *     description="Token given in email",
     *     type="string",
     *     example="9862e31df4072df8c4cf0ff8608fea8738ba7a0a6adee98902c957f40ae04342"
     * ),
     * @OA\Property(
     *     property="email",
     *     title="User's email",
     *     description="User's email",
     *     type="string",
     *     example="bob.ross@example.com"
     * ),
     * @OA\Property(
     *     property="password",
     *     title="User's password",
     *     description="new password of the user",
     *     type="string",
     *     example="Bobross123"
     * ),
     * @OA\Property(
     *     property="password_confirmation",
     *     title="User's password confirmation",
     *     description="Password confirmation of the user",
     *     type="string",
     *     example="Bobross123"
     * ),
     */
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
