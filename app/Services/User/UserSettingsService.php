<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Events\UserSettings\SettingsChangeEvent;
use App\Models\User;
use App\Models\UserSettings;

class UserSettingsService
{
    public function showSettings(User $user): UserSettings
    {
        return $user->userSettings;
    }

    public function update(User $user, array $data): UserSettings
    {
        $user->userSettings()->update($data);
        event(new SettingsChangeEvent("Settings change"));
        return $this->showSettings($user);
    }
}
