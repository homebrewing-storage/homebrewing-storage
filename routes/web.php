<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/login/github', [AuthenticationController::class, 'redirectGithub']);
Route::get('/login/github/callback', [AuthenticationController::class, 'callbackGithub']);
