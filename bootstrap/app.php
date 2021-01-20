<?php

declare(strict_types=1);

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Application;

$app = new Application($_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(ExceptionHandler::class, Handler::class);

return $app;
