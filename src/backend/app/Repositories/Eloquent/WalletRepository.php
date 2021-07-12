<?php

namespace App\Repositories\Eloquent;

use App\Constant\WalletDefinitions;
use App\Contract\Repository\WalletRepositoryInterface;
use App\Models\Wallet;
use App\Service\Modules\Register\Parameters\WalletParameters;

class WalletRepository extends BaseRepository implements WalletRepositoryInterface
{
    /**
     * WalletRepository constructor.
     *
     * @param Wallet $model
     */
    public function __construct(Wallet $model)
    {
        parent::__construct($model);
    }

    public function invitingReward(WalletParameters $parameters)
    {
        return $this->create([
            'user_id' => $parameters->getUser()->id,
            'amount' => WalletDefinitions::INVITING_USER_REWARD_AMOUNT,
            'description' => $parameters->getCode() . ' invite code has used'
        ]);
    }

    public function invitedReward(WalletParameters $parameters)
    {
        return $this->create([
            'user_id' => $parameters->getUser()->id,
            'amount' => WalletDefinitions::INVITED_USER_REWARD_AMOUNT,
            'description' => $parameters->getCode() . ' invite code has used by ' . $parameters->getFrom()
        ]);
    }
}
