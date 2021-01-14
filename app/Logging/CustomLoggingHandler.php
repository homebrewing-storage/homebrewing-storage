<?php

declare(strict_types=1);

namespace App\Logging;

use App\Models\UserLogs;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\AbstractProcessingHandler;

class CustomLoggingHandler extends AbstractProcessingHandler
{
    private $config;

    function __construct(array $config, array $processors, bool $bubble = true)
    {
        $this->config = $config;

        $level = $config['level'] ?? 'info';

        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        if (!Auth::check() && $this->checkLogContext($record)) {
            $record = $this->setUserByContext($record);
            $this->createLog($record);
        }
        if (Auth::check()) {
            $user = Auth::user();
            $user->logs()->create($record);
        }
    }

    private function checkLogContext(array $record): bool
    {
        return (in_array("Register", $record['context']) || in_array("Log", $record['context']));
    }

    private function setUserByContext(array $record): array
    {
        $record['user_id'] = $record['context'][1];
        unset($record['context'][1]);
        $record['context'] = array_values($record['context']);
        return $record;
    }

    private function createLog(array $record): void
    {
        $log = new UserLogs($record);
        $log->save();
    }
}
