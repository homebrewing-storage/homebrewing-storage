<?php

declare(strict_types=1);

namespace App\Http\Controllers\User\Settings;

use App\Http\Controllers\Contracts\UserSettingsInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserSettingsRequest;
use App\Http\Resources\User\UserSettingsResource;
use App\Services\User\UserSettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserSettingsController extends Controller implements UserSettingsInterface
{
    private UserSettingsService $service;

    public function __construct(UserSettingsService $service)
    {
        $this->service = $service;
    }

    public function show(Request $request): JsonResponse
    {
        $userSettings = $this->service->showSettings($request->user());
        return response()->json(new UserSettingsResource($userSettings));
    }

    public function update(UserSettingsRequest $request): JsonResponse
    {
        $user = $request->user();
        $dataRequest = $request->validated();
        $userSettings = $this->service->update($user, $dataRequest);
        return response()->json(new UserSettingsResource($userSettings), Response::HTTP_CREATED);
    }
}
