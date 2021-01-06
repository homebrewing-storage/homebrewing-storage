<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\SocialiteAuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

//GitHub
Route::get('/login/github', [SocialiteAuthController::class, 'redirectToGithub']);
Route::get('/login/github/callback', [SocialiteAuthController::class, 'callbackToGithub']);

//Facebook
Route::get('/login/facebook', [SocialiteAuthController::class, 'redirectToFacebook']);
Route::get('/login/facebook/callback', [SocialiteAuthController::class, 'callbackToFacebook']);

//Email Verification
Route::middleware('auth:sanctum')->prefix('/email')->group(function (): void {
    Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'accept'])
        ->middleware('signed')
        ->name('verification.verify');
});
