<?php

namespace App\Service\Modules\Invite\Handler\InviteHandler;

use App\Contract\Repository\InviteCodeRepositoryInterface;
use App\Jobs\InviteCodeSendEmail;
use App\Service\Modules\Common\AbstractChainHandler;
use App\Service\Modules\Common\ChainParameters\ChainParametersInterface;
use App\Service\Modules\Invite\Parameters\InviteChainParameters;

class InviteHandler extends AbstractChainHandler
{
    protected InviteCodeRepositoryInterface $repository;

    public function __construct(InviteCodeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function isProcessable(ChainParametersInterface $chainParameters): bool
    {
        /** @var InviteChainParameters $chainParameters * */
        return true;
    }

    public function process(ChainParametersInterface $chainParameters)
    {
        /*** @var InviteChainParameters $chainParameters */
        $to = $chainParameters->getInviteParameters()->getTo();
        $code = $chainParameters->getInviteParameters()->getCode();
        $userId = $chainParameters->getInviteParameters()->getUser()->id;

        $emailJob = new InviteCodeSendEmail($userId, $to, $code);

        dispatch($emailJob);

        $chainParameters->setIsInviteSuccess(true);
    }
}
