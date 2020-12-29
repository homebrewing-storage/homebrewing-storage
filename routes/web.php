<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\EmailVerificationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

//GitHub
Route::get('/login/github', [AuthenticationController::class, 'redirectToGithub']);
Route::get('/login/github/callback', [AuthenticationController::class, 'callbackToGithub']);

//Facebook
Route::get('/login/facebook', [AuthenticationController::class, 'redirectToFacebook']);
Route::get('/login/facebook/callback', [AuthenticationController::class, 'callbackToFacebook']);

//Email Verification
Route::middleware('auth:sanctum')->prefix('/email')->group(function (): void {
    Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'accept'])
        ->middleware('signed')
        ->name('verification.verify');
});
