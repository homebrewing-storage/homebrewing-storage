<?php

declare(strict_types=1);

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use App\Http\Resources\Log\LogResource;
use App\Services\Logs\UserLogsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserLogsController extends Controller
{
    public function index(Request $request, UserLogsService $service): JsonResponse
    {
        return response()->json(LogResource::collection($service->getUserLogs($request->user())));
    }
}
