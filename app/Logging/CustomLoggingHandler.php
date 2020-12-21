<?php

declare(strict_types=1);

namespace App\Logging;


use App\Exceptions\Auth\UnauthorizedException;
use App\Models\UserLogs;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\AbstractProcessingHandler;
use Illuminate\Support\Arr;

class CustomLoggingHandler extends AbstractProcessingHandler
{
    private $config;
    function __construct(array $config,  array $processors, bool $bubble = true)
    {

        $this->config = $config;

        $level = $config['level'] ?? 'info';

        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        if((in_array("Auth", $record['context'])) && (in_array("Log", $record['context'])))
        {
            $record = Arr::add($record, 'user_id', $record['context'][2]);
        } else {
            $user = Auth::user();
            $record = Arr::add($record, 'user_id', $user->id);
        }
        $log = new UserLogs($record);
        $log->save();
    }
}
