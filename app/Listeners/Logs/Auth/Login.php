<?php

declare(strict_types=1);

namespace App\Listeners\Logs\Auth;

class Login extends BaseAuth
{
    protected string $message = "Successfully logged in.";
}
