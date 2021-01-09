<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingsService
{
    public function showSettings(): UserSettings
    {
        return Auth::user()->userSettings;
    }

    public function update(Request $request): UserSettings
    {
        $userSettings = $request->user()->userSettings;
        $userSettings->update($request);
        return $userSettings;
    }
}
