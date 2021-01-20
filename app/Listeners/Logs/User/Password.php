<?php

declare(strict_types=1);

namespace App\Listeners\Logs\User;

class Password extends BaseUser
{
    protected string $message = "Successfully updated password.";
}
