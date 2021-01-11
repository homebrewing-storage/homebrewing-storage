<?php

declare(strict_types=1);

namespace App\Http\Requests\Ingredients;

use App\Http\Requests\BaseRequest;

/**
 * @OA\Schema(
 *      title="Fermentable form request",
 *      description="Fermentable form",
 *      type="object",
 *      required={"name", "type_id", "yield", "ebc", "amount", "expiration_date"}
 * )
 */
class FermentableRequest extends BaseRequest
{
    public function rules(): array
    {
        /**
         * @OA\Property(
         *     property="name",
         *     title="User's fermentable name",
         *     type="string",
         *     example="Illa"
         * ),
         * @OA\Property(
         *     property="type_id",
         *     title="User's fermentable type_id",
         *     type="string",
         *     example="2"
         * ),
         * @OA\Property(
         *     property="yield",
         *     title="User's fermentable type_id",
         *     type="string",
         *     example="2"
         * ),
         * @OA\Property(
         *     property="ebc",
         *     title="User's fermentable ebc value",
         *     type="string",
         *     example="2"
         * ),
         * @OA\Property(
         *     property="amount",
         *     title="User's fermentable amount",
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
        return [
            'name' => 'required|string|min:3|max:255',
            'type_id' => 'required|numeric|exists:fermentable_types,id',
            'yield' => 'required|numeric|min:1|max:255',
            'ebc' => 'required|numeric|min:1|max:255',
            'amount' => 'required|numeric|min:1',
            'expiration_date' => 'required|date'
        ];
    }
}
