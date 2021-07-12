<?php

namespace App\Service\Modules\Register\Parameters;

use App\Models\User;

use App\Service\Modules\Common\ChainParameters\ChainParametersInterface;

class RegisterChainParameters implements ChainParametersInterface
{
    protected bool $isRegisterSuccess = false;

    protected RegisterParameters $registerParameters;

    protected User $user;

    private ?\Throwable $lastException;

    public function isRegisterSuccess(): bool
    {
        return $this->isRegisterSuccess;
    }

    public function setIsRegisterSuccess(bool $isRegisterSuccess): RegisterChainParameters
    {
        $this->isRegisterSuccess = $isRegisterSuccess;
        return $this;
    }

    public function getRegisterParameters(): RegisterParameters
    {
        return $this->registerParameters;
    }

    public function setRegisterParameters(RegisterParameters $registerParameters): RegisterChainParameters
    {
        $this->registerParameters = $registerParameters;
        return $this;
    }

    public function setLastException(\Throwable $exception): ChainParametersInterface
    {
        $this->lastException = $exception;
        return $this;
    }

    public function getLastException(): ?\Throwable
    {
        return $this->lastException;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return RegisterChainParameters
     */
    public function setUser(User $user): RegisterChainParameters
    {
        $this->user = $user;
        return $this;
    }

    public function isCompleted(): bool
    {
        return $this->isRegisterSuccess();
    }

}
