<?php

declare(strict_types=1);

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

//Email Verification
Route::prefix('/email')->group(function (): void {
    Route::get('/verify', [AuthenticationController::class, 'verify'])
        ->middleware('auth:sanctum')
        ->name('verification.notice');

    Route::get('/verify/{id}/{hash}', [AuthenticationController::class, 'accept'])
        ->middleware(['auth:sanctum', 'signed'])
        ->name('verification.verify');

    Route::post('/verification-notification', [AuthenticationController::class, 'resend'])
        ->middleware(['auth:sanctum', 'throttle:6,1'])
        ->name('verification.send');
});

//Reset Password
Route::middleware('guest')->group(function (): void {
    Route::post('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'getToken'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

// Authorization
Route::middleware(['auth:sanctum', 'verified'])->group(function (): void {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});
