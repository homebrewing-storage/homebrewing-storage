<?php

declare(strict_types=1);

namespace App\Listeners\Logs\Auth;

use App\Events\Auth\BaseAuthEvent;
use App\Listeners\Logs\BaseLog;

abstract class BaseAuth extends BaseLog
{
    public function handle(BaseAuthEvent $event): void
    {
        $user = $event->getUser();
        $this->logger->channel('database')->info($this->message,
            [
                "Log",
                $user->id,
                "Success"
            ]
        );
    }
}
