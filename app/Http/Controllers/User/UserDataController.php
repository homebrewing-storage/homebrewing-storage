<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserDataResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        return response()->json(new UserDataResource($request->user()));
    }
}
