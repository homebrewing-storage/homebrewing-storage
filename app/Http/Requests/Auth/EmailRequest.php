<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

/**
 * @OA\Schema(
 *      title="Send password reset email",
 *      description="Send an email containing password reset link",
 *      type="object",
 *      required={"email"}
 * )
 */
class EmailRequest extends BaseRequest
{
    public function rules(): array
    {
        /**
         * @OA\Property(
         *     property="email",
         *     title="User's email",
         *     description="Email address of the user",
         *     type="string",
         *     example="bob.ross@example.com"
         * )
         */
        return [
            'email' => 'required|email|exists:users,email'
        ];
    }
}
