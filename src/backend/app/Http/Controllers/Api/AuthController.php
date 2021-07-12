<?php

namespace App\Http\Controllers\Api;

use App\Contract\Service\UserServiceInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Service\UserService;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use ApiResponser;

    /** @var UserService $userService * */
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        return $this->userService->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->userService->login($request);
    }

    public function logout()
    {
        return $this->userService->logout();
    }
}
