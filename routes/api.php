<?php

declare(strict_types=1);

use App\Http\Controllers\User\Credentials\ChangePasswordController;
use App\Http\Controllers\User\Settings\UserSettingsController;
use App\Http\Controllers\Notifications\IngredientExpirationController;
use App\Http\Controllers\Logs\UserLogsController;
use App\Http\Controllers\User\UserDataController;
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
use Illuminate\Routing\Router;

$router = app(Router::class);

// Authentication
$router->post('register', [AuthenticationController::class, 'register'])->name('register');
$router->post('login', [AuthenticationController::class, 'login'])->name('login');

//Email Verification
$router->middleware('auth:sanctum')->prefix('email/')->group(function (Router $router): void {
    $router->get('verify', [EmailVerificationController::class, 'verify'])
        ->name('verification.notice');

    $router->post('verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

//Reset Password
$router->middleware('guest')->group(function (Router $router): void {
    $router->post('forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.email');
    $router->get('reset-password/{token}', [ResetPasswordController::class, 'getToken'])->name('password.reset');
    $router->post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

// Authorization
$router->middleware(['auth:sanctum', 'verified'])->group(function (Router $router): void {

    //User's data
    $router->get('user', [UserDataController::class, 'show']);

    //Ingredients
    $router->apiResource('hops', HopController::class);
    $router->apiResource('yeasts', YeastController::class);
    $router->apiResource('fermentables', FermentableController::class);
    $router->apiResource('extras', ExtraController::class);

    //Types
    $router->get('extra-type', [ExtraController::class, 'types']);
    $router->get('fermentable-type', [FermentableController::class, 'types']);
    $router->get('yeast-type', [YeastController::class, 'types']);

    //Notifications
    $router->get('notifications', [IngredientExpirationController::class, 'index']);
    $router->get('unread-Notifications', [IngredientExpirationController::class, 'getUnread']);
    $router->get('number-Of-Unread-Notifications', [IngredientExpirationController::class, 'getNumberOfUnread']);
    $router->put('notifications/{notification}', [IngredientExpirationController::class, 'read']);
    $router->delete('notifications/{notification}', [IngredientExpirationController::class, 'destroy']);

    //User Actions
    $router->put('settings', [UserSettingsController::class, 'update']);
    $router->get('settings', [UserSettingsController::class, 'show']);
    $router->post('change-password', [ChangePasswordController::class, 'update']);
    $router->get('logs', [UserLogsController::class, 'index']);
    $router->post('logout', [AuthenticationController::class, 'logout'])->name('logout');
});
