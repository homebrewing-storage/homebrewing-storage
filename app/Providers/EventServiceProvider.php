<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\Auth\LoginEvent;
use App\Events\Auth\LogoutEvent;
use App\Events\Ingredient\AddedEvent;
use App\Events\Ingredient\DeletedEvent;
use App\Events\Ingredient\UpdatedEvent;
use App\Events\UserSettings\PasswordChangeEvent;
use App\Events\UserSettings\SettingsChangeEvent;
use App\Listeners\Logs\Auth\Login as LoginLog;
use App\Listeners\Logs\Auth\Logout as LogoutLog;
use App\Listeners\Logs\Auth\Register as RegisterLog;
use App\Listeners\Logs\Ingredient\Added as AddedLog;
use App\Listeners\Logs\Ingredient\Updated as UpdatedLog;
use App\Listeners\Logs\Ingredient\Deleted as DeletedLog;
use App\Listeners\Logs\User\Password as PasswordUpdated;
use App\Listeners\Logs\User\Settings as SettingsUpdated;
use App\Models\User;
use App\Observers\RegisterObserver;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            RegisterLog::class,
        ],
        LoginEvent::class => [
            LoginLog::class,
        ],
        LogoutEvent::class => [
            LogoutLog::class,
        ],
        AddedEvent::class => [
          AddedLog::class
        ],
        UpdatedEvent::class => [
            UpdatedLog::class
        ],
        DeletedEvent::class => [
            DeletedLog::class
        ],
        PasswordChangeEvent::class => [
            PasswordUpdated::class
        ],
        SettingsChangeEvent::class => [
            SettingsUpdated::class
        ],
        PasswordReset::class => [
            //
        ]
    ];

    public function boot()
    {
        User::observe(RegisterObserver::class);
    }
}
