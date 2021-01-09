<?php

declare(strict_types=1);

namespace App\Listeners\Logs\User;

use App\Events\UserSettings\BaseUserEvent;
use App\Listeners\Logs\BaseLog;

abstract class BaseUser extends BaseLog
{
    public function handle(BaseUserEvent $event): void
    {
        $type = $event->type;
        $this->logger->channel('database')->info($this->message,
            [
                "Auth",
                $type,
                "Success"
            ]
        );
    }
}
