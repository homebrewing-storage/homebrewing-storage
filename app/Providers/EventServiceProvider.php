<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\Auth\LoginEvent;
use App\Events\Auth\LogoutEvent;
use App\Listeners\Logs\Auth\Login as LoginLog;
use App\Listeners\Logs\Auth\Logout as LogoutLog;
use App\Listeners\Logs\Auth\Register as RegisterLog;
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
        PasswordReset::class => [
            //
        ]
    ];
}
