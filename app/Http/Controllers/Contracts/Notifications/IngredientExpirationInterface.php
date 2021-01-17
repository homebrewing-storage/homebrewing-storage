<?php

namespace App\Http\Controllers\Contracts;

use App\Models\IngredientExpiration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface IngredientExpirationInterface
{
    /**
     * @OA\Get(
     *     path="/api/notifications",
     *     operationId="index",
     *     tags={"Notifications"},
     *     summary="Get all notifications of a user",
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
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse;

    /**
     * @OA\Get(
     *     path="/api/unread-Notifications",
     *     operationId="getUnread",
     *     tags={"Notifications"},
     *     summary="Get all notifications of a user",
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
     * @return JsonResponse
     */
    public function getUnread(Request $request): JsonResponse;

    /**
     * @OA\Get(
     *     path="/api/unreadNotifications",
     *     operationId="getNumberOfUnread",
     *     tags={"Notifications"},
     *     summary="Get all unread notifications of a user",
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
     * @return JsonResponse
     */
    public function getNumberOfUnread(Request $request): JsonResponse;


    /**
     * @OA\Delete(
     *     path="/api/notifications/{notification}",
     *     operationId="destroy",
     *     tags={"Notifications"},
     *     summary="Delete read notification of a user",
     *     @OA\Response(
     *     response=204,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *      security={{ "apiAuth": {} }},
     * )
     * @param IngredientExpiration $notification
     * @return JsonResponse
     */
    public function destroy(IngredientExpiration $notification): JsonResponse;

    /**
     * @OA\Put(
     *     path="/api/notifications/{notification}",
     *     operationId="read",
     *     tags={"Notifications"},
     *     summary="Mark as read notification of a user",
     *     @OA\Response(
     *     response=201,
     *     description="Successful operation"
     * ),
     *     @OA\Response(
     *     response=401,
     *     description="Unauthenticated"
     * ),
     *      security={{ "apiAuth": {} }},
     * )
     * @param IngredientExpiration $notification
     * @return JsonResponse
     */
    public function read(IngredientExpiration $notification): JsonResponse;
}
