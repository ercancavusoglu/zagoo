<?php

namespace App\Service\Modules\Register\Handler\RegisterHandler;

use App\Contract\Repository\UserRepositoryInterface;
use App\Service\Modules\Common\AbstractChainHandler;
use App\Service\Modules\Common\ChainParameters\ChainParametersInterface;
use App\Service\Modules\Register\Parameters\RegisterChainParameters;
use Illuminate\Support\Facades\DB;

class RegisterHandler extends AbstractChainHandler
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function isProcessable(ChainParametersInterface $chainParameters): bool
    {
        return true;
    }

    public function process(ChainParametersInterface $chainParameters)
    {
        try {
            DB::beginTransaction();

            /*** @var RegisterChainParameters $chainParameters */
            $user = $this->userRepository->save($chainParameters->getRegisterParameters());

            $chainParameters->setIsRegisterSuccess(true);
            $chainParameters->setUser($user);

            DB::commit();

            return $chainParameters;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
