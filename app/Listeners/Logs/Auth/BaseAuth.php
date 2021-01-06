<?php

declare(strict_types=1);

namespace App\Listeners\Logs\Auth;

use App\Events\BaseEvent;
use App\Listeners\Logs\BaseLog;

abstract class BaseAuth extends BaseLog
{
    public function handle(BaseEvent $event): void
    {
        $user = $event->getUser();
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
