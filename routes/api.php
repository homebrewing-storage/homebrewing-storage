<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HopController;
use App\Http\Controllers\YeastController;
use App\Http\Controllers\FermentableController;
use App\Http\Controllers\ExtraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

//Email Verification
Route::prefix('/email')->group(function (): void {
    Route::get('/verify', [EmailVerificationController::class, 'verify'])
        ->middleware('auth:sanctum')
        ->name('verification.notice');

    Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'accept'])
        ->middleware(['auth:sanctum', 'signed'])
        ->name('verification.verify');

    Route::post('/verification-notification', [EmailVerificationController::class, 'resend'])
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
    Route::get('hops', [HopController::class, 'index']);
    Route::get('hops/{hop}', [HopController::class, 'show']);
    Route::post('hops', [HopController::class, 'store']);
    Route::put('hops/{hop}', [HopController::class, 'update']);
    Route::delete('hops/{hop}', [HopController::class, 'destroy']);

    Route::get('yeasts', [YeastController::class, 'index']);
    Route::get('yeasts/{yeast}', [YeastController::class, 'show']);
    Route::post('yeasts', [YeastController::class, 'store']);
    Route::put('yeasts/{yeast}', [YeastController::class, 'update']);
    Route::delete('yeasts/{yeast}', [YeastController::class, 'destroy']);

    Route::get('fermentables', [FermentableController::class, 'index']);
    Route::get('fermentables/{fermentable}', [FermentableController::class, 'show']);
    Route::post('fermentables', [FermentableController::class, 'store']);
    Route::put('fermentables/{fermentable}', [FermentableController::class, 'update']);
    Route::delete('fermentables/{fermentable}', [FermentableController::class, 'destroy']);

    Route::get('extras', [ExtraController::class, 'index']);
    Route::get('extras/{extra}', [ExtraController::class, 'show']);
    Route::post('extras', [ExtraController::class, 'store']);
    Route::put('extras/{extra}', [ExtraController::class, 'update']);
    Route::delete('extras/{extra}', [ExtraController::class, 'destroy']);
});