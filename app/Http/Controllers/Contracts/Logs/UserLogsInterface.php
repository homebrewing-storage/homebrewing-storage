<?php

namespace App\Http\Controllers\Contracts;

use App\Services\Logs\UserLogsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface UserLogsInterface
{
    /**
     * @OA\Get(
     *     path="/api/logs",
     *     operationId="index",
     *     tags={"Logs"},
     *     summary="Get all logs of a user",
     *     @OA\Response(
     *     response=200,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *      security={{ "apiAuth": {} }},
     * )
     * @param Request $request
     * @param UserLogsService $service
     * @return JsonResponse
     */
    public function index(Request $request, UserLogsService $service): JsonResponse;
}
