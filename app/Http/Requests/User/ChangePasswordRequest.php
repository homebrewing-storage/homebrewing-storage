<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

/**
 * @OA\Schema(
 *      title="Password change user request",
 *      description="Change user's password using request body data",
 *      type="object",
 *      required={"password", "password_new", "password_confirmation",}
 * )
 */
class ChangePasswordRequest extends BaseRequest
{
    /**
     * @OA\Property(
     *     property="password",
     *     title="User's password",
     *     description="Current password of the user",
     *     type="string",
     *     example="Bobross123"
     * ),
     * @OA\Property(
     *     property="password_new",
     *     title="New password",
     *     description="New password of the user",
     *     type="string",
     *     example="Bobross1234"
     * ),
     * @OA\Property(
     *     property="password_confirmation",
     *     title="New password confirmation",
     *     description="New password confirmation of the user",
     *     type="string",
     *     example="Bobross1234"
     * ),
     * @return array
     */
    public function rules(): array
    {
        return [
            'password' => 'required|password:sanctum',
            'password_new' => 'required|string|min:6|max:10|same:password_confirmation',
            'password_confirmation' => 'required',
        ];
    }
}
