<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordService
{
    public function update(Request $request): void
    {
        $user = Auth::user();
        $user->password = Hash::make($request->password_new);
        $user->save();
    }
}