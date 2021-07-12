<?php

namespace App\Contract\Repository;

use App\Service\Modules\Register\Parameters\WalletParameters;

interface WalletRepositoryInterface
{
    public function invitingReward(WalletParameters $parameters);

    public function invitedReward(WalletParameters $parameters);
}
