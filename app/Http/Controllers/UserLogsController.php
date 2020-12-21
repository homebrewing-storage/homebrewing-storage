<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogResource;
use App\Services\UserLogsService;
use Illuminate\Http\JsonResponse;

class UserLogsController extends Controller
{
    public function index(UserLogsService $logsService): JsonResponse
    {
        $logs = $logsService->getUserLogs();
        return response()->json(LogResource::collection($logs));
    }
}
