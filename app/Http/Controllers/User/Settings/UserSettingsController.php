<?php

declare(strict_types=1);

namespace App\Http\Controllers\User\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSettingsFormRequest;
use App\Http\Resources\UserSettingsResource;
use App\Events\UserSettings\SettingsChangeEvent;
use App\Services\UserSettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserSettingsController extends Controller
{
    public function show(UserSettingsService $settingsService): JsonResponse
    {
        $userSettings = $settingsService->showSettings();
        return response()->json(new UserSettingsResource($userSettings));
    }

    public function update(UserSettingsFormRequest $request, UserSettingsService $settingsService): JsonResponse
    {
        $dataRequest = $request->validated();
        $userSettings = $settingsService->update($dataRequest);
        event(new SettingsChangeEvent("Settings change"));

        return response()->json(new UserSettingsResource($userSettings), Response::HTTP_CREATED);
    }
}
