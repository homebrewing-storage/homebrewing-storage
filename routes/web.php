<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

//GitHub
Route::get('/login/github', [AuthenticationController::class, 'redirectToGithub']);
Route::get('/login/github/callback', [AuthenticationController::class, 'callbackToGithub']);

//Google
Route::get('/login/google', [AuthenticationController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [AuthenticationController::class, 'callbackToGoogle']);

//Facebook
Route::get('/login/facebook', [AuthenticationController::class, 'redirectToFacebook']);
Route::get('/login/facebook/callback', [AuthenticationController::class, 'callbackToFacebook']);
