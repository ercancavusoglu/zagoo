<?php

namespace App\Service;

use App\Contract\Service\UserServiceInterface;
use App\Http\Requests\InviteRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Service\Modules\Invite\InviteManager;
use App\Service\Modules\Login\LoginManager;
use App\Service\Modules\Register\RegisterManager;
use App\Traits\ApiResponser;

class UserService implements UserServiceInterface
{
    use ApiResponser;

    private RegisterManager $registerManager;
    private InviteManager $inviteManager;
    private LoginManager $loginManager;

    public function __construct(
        LoginManager $loginManager,
        RegisterManager $registerManager,
        InviteManager $inviteManager
    )
    {
        $this->loginManager = $loginManager;
        $this->registerManager = $registerManager;
        $this->inviteManager = $inviteManager;
    }

    public function login(LoginRequest $request)
    {
        return $this->loginManager->login($request);
    }

    public function register(RegisterRequest $request)
    {
        return $this->registerManager->register($request);
    }

    public function invite(InviteRequest $request)
    {
        return $this->inviteManager->invite($request);
    }

    public function logout()
    {
        return $this->loginManager->logout();
    }
}
