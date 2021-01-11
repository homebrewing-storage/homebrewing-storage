<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Contracts\SocialiteAuthInterface;
use App\Services\Auth\SocialiteAuthService;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\SocialiteManager;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialiteAuthController extends BaseAuthController implements SocialiteAuthInterface
{
    private SocialiteManager $manager;
    private SocialiteAuthService $service;

    public function __construct(SocialiteManager $manager, SocialiteAuthService $service)
    {
        $this->manager = $manager;
        $this->service = $service;
    }

    public function redirectToGithub(): RedirectResponse
    {
        return $this->manager->driver('github')->redirect();
    }

    public function callbackToGithub(): JsonResponse
    {
        $user = $this->manager->driver('github')->stateless()->user();
        $token = $this->service->loginOrRegister($user, 'github');
        return $this->responseJson(__('auth.success'), $token);
    }

    public function redirectToFacebook(): RedirectResponse
    {
        return $this->manager->driver('facebook')->redirect();
    }

    public function callbackToFacebook(): JsonResponse
    {
        $user = $this->manager->driver('facebook')->stateless()->user();
        $token = $this->service->loginOrRegister($user, 'facebook');
        return $this->responseJson(__('auth.success'), $token);
    }
}
