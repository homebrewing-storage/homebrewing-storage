<?php

declare(strict_types=1);

namespace App\Http\Requests\Ingredients;

use App\Http\Requests\BaseRequest;

/**
 * @OA\Schema(
 *      title="Hop form request",
 *      description="Hop form",
 *      type="object",
 *      required={"name", "alpha_acid", "amount", "expiration_date"}
 * )
 */
class HopRequest extends BaseRequest
{
    /**
     * @OA\Property(
     *     property="name",
     *     title="User's hop name",
     *     type="string",
     *     example="Illa"
     * ),
     * @OA\Property(
     *     property="alpha_acid",
     *     title="User's hop alpha acid",
     *     type="string",
     *     example="2"
     * ),
     * @OA\Property(
     *     property="amount",
     *     title="User's hop amount",
     *     type="string",
     *     example="2"
     * ),
     * @OA\Property(
     *     property="expiration_date",
     *     title="User's hop expiration date",
     *     type="datetime",
     *     example="2020-01-04"
     * ),
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'alpha_acid' => 'required|numeric|min:1|max:3',
            'amount' => 'required|numeric|min:1',
            'expiration_date' => 'required|date'
        ];
    }
}
