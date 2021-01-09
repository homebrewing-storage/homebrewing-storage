<?php


namespace App\Events\UserSettings;


abstract class BaseUserEvent
{
    public string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }
}
