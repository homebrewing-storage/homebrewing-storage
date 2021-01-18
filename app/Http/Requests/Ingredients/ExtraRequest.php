<?php

declare(strict_types=1);

namespace App\Http\Requests\Ingredients;

use App\Http\Requests\BaseRequest;

/**
 * @OA\Schema(
 *      title="Extra form request",
 *      description="Extra form",
 *      type="object",
 *      required={"name", "type_id", "amount", "expiration_date"}
 * )
 */
class ExtraRequest extends BaseRequest
{
    /**
     * @OA\Property(
     *     property="name",
     *     title="User's extra name",
     *     type="string",
     *     example="Illa"
     * ),
     * @OA\Property(
     *     property="type_id",
     *     title="User's extra type_id",
     *     type="string",
     *     example="2"
     * ),
     * @OA\Property(
     *     property="amount",
     *     title="User's extra expiration date",
     *     type="datetime",
     *     example="2020-01-04"
     * ),
     * @OA\Property(
     *     property="expiration_date",
     *     title="User's extra expiration date",
     *     type="datetime",
     *     example="2020-01-04"
     * ),
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'type_id' => 'required|numeric|exists:extra_types,id',
            'amount' => 'required|numeric|min:1',
            'expiration_date' => 'required|date'
        ];
    }
}
