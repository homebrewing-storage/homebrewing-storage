<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserDataResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/user",
     *      operationId="show",
     *      tags={"User's data"},
     *      summary="Fetches user's data",
     *      description="Fetches user's data",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      )
     *     )
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        return response()->json(new UserDataResource($request->user()));
    }
}
