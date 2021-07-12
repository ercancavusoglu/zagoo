<?php

namespace App\Service\Modules\Invite\Handler\CheckInviteHandler;

use App\Contract\Repository\InviteCodeRepositoryInterface;
use App\Exceptions\InviteCodeException;
use App\Models\InviteCodes;
use App\Service\Modules\Common\AbstractChainHandler;
use App\Service\Modules\Common\ChainParameters\ChainParametersInterface;
use App\Service\Modules\Invite\Parameters\InviteChainParameters;

class CheckInviteHandler extends AbstractChainHandler
{
    protected InviteCodeRepositoryInterface $repository;

    public function __construct(InviteCodeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function isProcessable(ChainParametersInterface $chainParameters): bool
    {
        return true;
    }

    public function process(ChainParametersInterface $chainParameters)
    {
        /*** @var InviteChainParameters $chainParameters */

        /** @var InviteCodes|null $invite * */
        $invite = $this->repository->check($chainParameters->getInviteParameters());

        if (!$invite) {
            return $chainParameters;
        }

        if ($invite->isUsed === 1) {
            throw new InviteCodeException();
        }

        return $chainParameters;
    }
}
