<?php

declare(strict_types=1);

namespace App\Listeners\Logs\Auth;

use App\Listeners\Logs\BaseLog;
use Illuminate\Auth\Events\Registered;

class Register extends BaseLog
{
    protected string $message = "User has been registered";

    public function handle(Registered $event): void
    {
        $user = $event->user;
        $this->logger->channel('database')->info($this->message,
            [
                "Auth",
                "Log",
                $user->id,
                "Success"
            ]
        );
    }
}
