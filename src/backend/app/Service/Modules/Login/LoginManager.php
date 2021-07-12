<?php

namespace App\Service\Modules\Login;

use App\Http\Requests\LoginRequest;
use App\Service\Modules\Common\AbstractManager;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginManager extends AbstractManager
{
    use ApiResponser;

    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->all())) {
            return $this->error('Credentials not match', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
