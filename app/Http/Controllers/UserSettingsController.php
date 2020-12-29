<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserSettingsFormRequest;
use App\Http\Resources\UserSettingsResource;
use App\Services\UserSettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserSettingsController extends Controller
{
    public function show(UserSettingsService $settingsService): JsonResponse
    {
        $userSettings = $settingsService->showSettings();
        return response()->json(new UserSettingsResource($userSettings));
    }

    public function update(UserSettingsFormRequest $request, UserSettingsService $settingsService)
    {
        $dataRequest = $this->getDataRequest($request);
        $userSettings = $settingsService->update($dataRequest);

        Log::channel('database')->info("Successfully updated settings.", [
            "Auth", "Settings change", " ", " ", "Success"
        ]);

        return response()->json(new UserSettingsResource($userSettings), Response::HTTP_CREATED);
    }

    private function getDataRequest(Request $request): array
    {
        return $request->only('reminder', 'email', 'hop', 'yeast', 'fermentable', 'extra');
    }
}
