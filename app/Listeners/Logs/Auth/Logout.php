<?php

declare(strict_types=1);

namespace App\Listeners\Logs\Auth;

class Logout extends BaseAuth
{
    protected string $message = "Successfully logged out.";
}
