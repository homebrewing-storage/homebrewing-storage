<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

/**
 * @OA\Schema(
 *      title="Change user's settings",
 *      description="Change user's settings",
 *      type="object",
 *      required={"reminder", "email", "hop", "yeast", "fermentable", "extra"}
 * )
 */
class UserSettingsRequest extends BaseRequest
{
    /**
     * @OA\Property(
     *     property="reminder",
     *     title="Reminder in days",
     *     description="Specifies when to notify user",
     *     type="string",
     *     example="7"
     * ),
     * @OA\Property(
     *     property="email",
     *     title="Email notification",
     *     description="Decides if user wants to receive an email notification",
     *     type="string",
     *     example="1"
     * ),
     * @OA\Property(
     *     property="hop",
     *     title="Hop notification",
     *     description="Decides if user wants to receive a notification about expiring hops",
     *     type="string",
     *     example="1"
     * ),
     * @OA\Property(
     *     property="yeast",
     *     title="Yeast notification",
     *     description="Decides if user wants to receive a notification about expiring yeasts",
     *     type="string",
     *     example="1"
     * ),
     * @OA\Property(
     *     property="fermentable",
     *     title="Fermentable notification",
     *     description="Decides if user wants to receive a notification about expiring fermentables",
     *     type="string",
     *     example="0"
     * ),
     * @OA\Property(
     *     property="extra",
     *     title="Extra notification",
     *     description="Decides if user wants to receive a notification about expiring extras",
     *     type="string",
     *     example="0"
     * ),
     */
    public function rules(): array
    {
        return [
            'reminder' => 'required|numeric|between:1,14',
            'email' => 'required|boolean',
            'hop' => 'required|boolean',
            'yeast' => 'required|boolean',
            'fermentable' => 'required|boolean',
            'extra' => 'required|boolean',
        ];
    }
}
