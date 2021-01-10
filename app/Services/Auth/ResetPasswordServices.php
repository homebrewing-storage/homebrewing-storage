<?php

declare(strict_types=1);

namespace App\Services\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;

class ResetPasswordServices
{
    private PasswordBroker $passwordBroker;
    private Hasher $hash;

    public function __construct(PasswordBroker $passwordBroker, Hasher $hash)
    {
        $this->passwordBroker = $passwordBroker;
        $this->hash = $hash;
    }

    public function sendResetLink(array $email): array
    {
        $status = $this->passwordBroker->sendResetLink($email);
        return $this->checkStatus($status, $this->passwordBroker::RESET_LINK_SENT);
    }

    public function resetPassword(array $data, Request $request): array
    {
        $status = $this->passwordBroker->reset(
            $data,
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => $this->hash->make($password)
                ])->save();
                event(new PasswordReset($user));
            }
        );
        return $this->checkStatus($status, $this->passwordBroker::PASSWORD_RESET);
    }

    private function checkStatus(string $status, string $baseStatus): array
    {
        if ($status == $baseStatus) {
            return ['status' => __($status)];
        } else {
            return ['email' => __($status)];
        }
    }
}
