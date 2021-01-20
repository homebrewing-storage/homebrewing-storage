<?php

declare(strict_types=1);

namespace App\Events\UserSettings;

abstract class BaseUserEvent
{
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
