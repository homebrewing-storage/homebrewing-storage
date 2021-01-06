<?php

declare(strict_types=1);

namespace App\Listeners\Logs;

use Illuminate\Log\LogManager;

abstract class BaseLog
{
    protected LogManager $logger;
    protected string $message;

    public function __construct(LogManager $logger)
    {
        $this->logger = $logger;
    }
}
