<?php

declare(strict_types=1);

namespace App\Http\Requests\Ingredients;

use App\Http\Requests\BaseRequest;

/**
 * @OA\Schema(
 *      title="Yeast form request",
 *      description="Yeast form",
 *      type="object",
 *      required={"name", "type_id", "amount", "expiration_date"}
 * )
 */
class YeastRequest extends BaseRequest
{
    /**
     * @OA\Property(
     *     property="name",
     *     title="User's yeast name",
     *     type="string",
     *     example="Illa"
     * ),
     * @OA\Property(
     *     property="type_id",
     *     title="User's yeast type_id",
     *     type="string",
     *     example="2"
     * ),
     * @OA\Property(
     *     property="amount",
     *     title="User's yeast amount",
     *     type="string",
     *     example="20"
     * ),
     * @OA\Property(
     *     property="expiration_date",
     *     title="User's yeast expiration date",
     *     type="datetime",
     *     example="2020-01-04"
     * ),
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'type_id' => 'required|numeric|exists:yeast_types,id',
            'amount' => 'required|numeric|min:1',
            'expiration_date' => 'required|date'
        ];
    }
}
