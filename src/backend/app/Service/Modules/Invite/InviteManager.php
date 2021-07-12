<?php

namespace App\Service\Modules\Invite;

use App\Exceptions\ChainHandlerException;
use App\Http\Requests\InviteRequest;
use App\Service\Modules\Common\AbstractManager;
use App\Service\Modules\Invite\Handler\CheckInviteHandler\CheckInviteHandler;
use App\Service\Modules\Invite\Handler\InviteHandler\InviteHandler;
use App\Service\Modules\Invite\Parameters\InviteChainParameters;
use App\Service\Modules\Invite\Parameters\InviteParametersBuilder;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;

class InviteManager extends AbstractManager
{
    use ApiResponser;

    /**
     * InviteManager constructor.
     *
     * It should append to new chain handler for running process
     * If handler is not processable, current chain goes to skip handler
     * If handler is processable, process function running at current chain
     * If handler has exception, processes stop and exception throw it
     *
     * @param CheckInviteHandler $checkInviteHandler
     * @param InviteHandler $inviteHandler
     */
    public function __construct(
        CheckInviteHandler $checkInviteHandler,
        InviteHandler $inviteHandler
    )
    {
        $checkInviteHandler
            ->setSuccessHandler($inviteHandler)
            ->setSkipHandler(null)
            ->setExceptionHandler(null);

        $inviteHandler
            ->setSuccessHandler(null)
            ->setExceptionHandler(null)
            ->setSkipHandler(null);

        $this->setInitHandler($checkInviteHandler);
    }

    /**
     * @param InviteRequest $request
     * @return JsonResponse
     * @throws ChainHandlerException
     * @throws \Throwable
     */
    public function invite(InviteRequest $request): JsonResponse
    {
        $chainParameters = InviteParametersBuilder::build($request);

        /** @var InviteChainParameters $response */
        $response = $this->getInitHandler()->handle($chainParameters);

        if (!$response->isCompleted()) {
            return $this->error('Something went wrong', 500);
        }

        return $this->success([
            'status' => 'succes'
        ]);
    }
}
