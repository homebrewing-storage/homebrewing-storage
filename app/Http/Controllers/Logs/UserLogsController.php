<?php

declare(strict_types=1);

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use App\Http\Resources\LogResource;
use App\Services\UserLogsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserLogsController extends Controller
{
    public function index(Request $request, UserLogsService $service): JsonResponse
    {
        $user = $request->user();
        return response()->json(LogResource::collection($service->getUserLogs($user)));
    }
}
