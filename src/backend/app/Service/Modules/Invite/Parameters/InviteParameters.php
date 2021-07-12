<?php

namespace App\Service\Modules\Invite\Parameters;

use App\Models\User;

class InviteParameters
{
    protected string $to;
    protected string $code;
    protected User $user;

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     * @return InviteParameters
     */
    public function setTo(string $to): InviteParameters
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return InviteParameters
     */
    public function setCode(string $code): InviteParameters
    {
        $this->code = $code;
        return $this;
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
     * @return InviteParameters
     */
    public function setUser(User $user): InviteParameters
    {
        $this->user = $user;
        return $this;
    }
}
