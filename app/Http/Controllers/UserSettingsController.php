<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserSettingsFormRequest;
use App\Http\Resources\UserSettingsResource;
use App\Models\UserSettings;
use App\Services\UserSettingsService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function show(UserSettingsService $settingsService): JsonResource
    {
        $userSettings = $settingsService->showSettings();
        return response()->json(new UserSettingsResource($userSettings));
    }

    public function update(UserSettingsFormRequest $request, UserSettingsService $settingsService)
    {
        $dataRequest = $this->getDataRequest($request);
        $userSettings = $settingsService->update($dataRequest);
        return response()->json(new UserSettingsResource($userSettings), Response::HTTP_CREATED);
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('reminder', 'email', 'hop', 'yeast', 'fermentable', 'extra');
    }
}
