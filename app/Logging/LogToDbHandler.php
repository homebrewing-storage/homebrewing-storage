<?php

declare(strict_types=1);

namespace App\Logging;

use Monolog\Logger;

class LogToDbHandler
{
    public function __invoke(array $config): Logger
    {
        return new Logger(
            $config['name'],
            [new CustomLoggingHandler($config, [])],
            []
        );
    }
}
