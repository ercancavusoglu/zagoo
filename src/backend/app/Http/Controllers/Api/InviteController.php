<?php

namespace App\Http\Controllers\Api;

use App\Contract\Service\UserServiceInterface;
use App\Http\Requests\InviteRequest;
use App\Service\UserService;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class InviteController extends Controller
{
    use ApiResponser;

    /** @var UserService $userService * */
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function invite(InviteRequest $request)
    {
        return $this->userService->invite($request);
    }
}
