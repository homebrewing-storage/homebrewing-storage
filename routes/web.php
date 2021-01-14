<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\SocialiteAuthController;
use Illuminate\Routing\Router;

$router = app(Router::class);

$router->view('/', 'welcome');

//GitHub
$router->get('/login/github', [SocialiteAuthController::class, 'redirectToGithub']);
$router->get('/login/github/callback', [SocialiteAuthController::class, 'callbackToGithub']);

//Facebook
$router->get('/login/facebook', [SocialiteAuthController::class, 'redirectToFacebook']);
$router->get('/login/facebook/callback', [SocialiteAuthController::class, 'callbackToFacebook']);

//Email Verification
$router->middleware('auth:sanctum')->prefix('/email')->group(function (Router $router): void {
    $router->get('/verify/{id}/{hash}', [EmailVerificationController::class, 'accept'])
        ->middleware('signed')
        ->name('verification.verify');
});
