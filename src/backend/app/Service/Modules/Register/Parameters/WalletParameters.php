<?php

namespace App\Service\Modules\Register\Parameters;

use App\Models\User;

class WalletParameters
{
    protected User $user;

    protected string $code;

    protected string $from;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return WalletParameters
     */
    public function setUser(User $user): WalletParameters
    {
        $this->user = $user;
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
     * @return WalletParameters
     */
    public function setCode(string $code): WalletParameters
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $from
     * @return WalletParameters
     */
    public function setFrom(string $from): WalletParameters
    {
        $this->from = $from;
        return $this;
    }
}
