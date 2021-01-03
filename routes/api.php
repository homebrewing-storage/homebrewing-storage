<?php

declare(strict_types=1);

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\IngredientExpirationController;
use App\Http\Controllers\UserLogsController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\Auth\{
    AuthenticationController,
    EmailVerificationController,
    ResetPasswordController
};
use App\Http\Controllers\Ingredients\{
    HopController,
    YeastController,
    FermentableController,
    ExtraController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

//Email Verification
Route::middleware('auth:sanctum')->prefix('/email')->group(function (): void {
    Route::get('/verify', [EmailVerificationController::class, 'verify'])
        ->name('verification.notice');

    Route::post('/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
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

    Route::get('/extra-type', [ExtraController::class, 'types']);
    Route::get('/fermentable-type', [FermentableController::class, 'types']);
    Route::get('/yeast-type', [YeastController::class, 'types']);

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

    Route::get('notifications', [IngredientExpirationController::class, 'index']);
    Route::get('unreadNotifications', [IngredientExpirationController::class, 'show']);
    Route::delete('notifications/{notification}', [IngredientExpirationController::class, 'destroy']);
    Route::put('notifications/{notification}', [IngredientExpirationController::class, 'update']);

    Route::put('settings', [UserSettingsController::class, 'update']);
    Route::get('settings', [UserSettingsController::class, 'show']);

    Route::post('change-password', [ChangePasswordController::class, 'update']);

    Route::get('logs', [UserLogsController::class, 'index']);
});
