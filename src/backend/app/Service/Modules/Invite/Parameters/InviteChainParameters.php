<?php

namespace App\Service\Modules\Invite\Parameters;

use App\Models\User;

use App\Service\Modules\Common\ChainParameters\ChainParametersInterface;

class InviteChainParameters implements ChainParametersInterface
{
    protected bool $isInviteSuccess = false;

    protected InviteParameters $inviteParameters;

    private ?\Throwable $lastException;

    public function isInviteSuccess(): bool
    {
        return $this->isInviteSuccess;
    }

    public function setIsInviteSuccess(bool $isInviteSuccess): InviteChainParameters
    {
        $this->isInviteSuccess = $isInviteSuccess;
        return $this;
    }

    public function getInviteParameters(): InviteParameters
    {
        return $this->inviteParameters;
    }

    public function setInviteParameters(InviteParameters $InviteParameters): InviteChainParameters
    {
        $this->inviteParameters = $InviteParameters;
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


    public function isCompleted(): bool
    {
        return $this->isInviteSuccess();
    }
}
