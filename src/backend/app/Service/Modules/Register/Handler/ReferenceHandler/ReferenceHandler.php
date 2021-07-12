<?php

namespace App\Service\Modules\Register\Handler\ReferenceHandler;

use App\Contract\Repository\InviteCodeRepositoryInterface;
use App\Contract\Repository\WalletRepositoryInterface;
use App\Models\InviteCodes;
use App\Repositories\Eloquent\InviteCodeRepository;
use App\Service\Modules\Common\AbstractChainHandler;
use App\Service\Modules\Common\ChainParameters\ChainParametersInterface;
use App\Service\Modules\Register\Parameters\RegisterChainParameters;
use App\Service\Modules\Register\Parameters\WalletParameters;
use Illuminate\Support\Facades\Log;

class ReferenceHandler extends AbstractChainHandler
{
    protected InviteCodeRepositoryInterface $inviteCodeRepository;
    protected WalletRepositoryInterface $walletRepository;

    public function __construct(
        InviteCodeRepositoryInterface $repository,
        WalletRepositoryInterface $walletRepository
    )
    {
        $this->inviteCodeRepository = $repository;
        $this->walletRepository = $walletRepository;
    }

    public function isProcessable(ChainParametersInterface $chainParameters): bool
    {
        /** @var RegisterChainParameters $chainParameters * */
        return $chainParameters->getRegisterParameters()->getReferenceCode() !== null;
    }

    public function process(ChainParametersInterface $chainParameters)
    {
        /** @var RegisterChainParameters $chainParameters * */
        /** @var InviteCodes $inviteCodeEntity */
        $inviteCodeEntity = $this->inviteCodeRepository->findByCode($chainParameters->getRegisterParameters());

        $inviteCode = $chainParameters->getRegisterParameters()->getReferenceCode();

        if (!$inviteCodeEntity) {
            Log::debug(
                'Reference Not Found',
                [
                    'email' => $chainParameters->getRegisterParameters()->getEmail(),
                    'reference' => $inviteCode
                ]
            );
            return null;
        }

        $this->inviteCodeRepository->updateByCode($inviteCodeEntity);

        $referenceUser = $inviteCodeEntity->user;
        $user = $chainParameters->getUser();

        $this->walletRepository->invitedReward(
            (new WalletParameters())
                ->setUser($referenceUser)
                ->setCode($inviteCode)
                ->setFrom($inviteCodeEntity['to'])
        );

        $this->walletRepository->invitingReward(
            (new WalletParameters())
                ->setUser($user)
                ->setCode($inviteCode)
        );

        $chainParameters->setIsRegisterSuccess(true);

        return $chainParameters;
    }
}
