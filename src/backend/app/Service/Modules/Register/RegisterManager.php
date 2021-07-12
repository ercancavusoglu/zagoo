<?php

namespace App\Service\Modules\Register;

use App\Exceptions\ChainHandlerException;
use App\Http\Requests\RegisterRequest;
use App\Service\Modules\Common\AbstractManager;
use App\Service\Modules\Register\Handler\ReferenceHandler\ReferenceHandler;
use App\Service\Modules\Register\Handler\RegisterHandler\RegisterHandler;
use App\Service\Modules\Register\Parameters\RegisterChainParameters;
use App\Service\Modules\Register\Parameters\RegisterParametersBuilder;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;

class RegisterManager extends AbstractManager
{
    use ApiResponser;

    /**
     * RegisterManager constructor.
     *
     * It should append to new chain handler for running process
     * If handler is not processable, current chain goes to skip handler
     * If handler is processable, process function running at current chain
     * If handler has exception, processes stop and exception throw it
     *
     * @param RegisterHandler $registerHandler
     * @param ReferenceHandler $referenceHandler
     */
    public function __construct(
        RegisterHandler $registerHandler,
        ReferenceHandler $referenceHandler
    ) {
        $registerHandler
            ->setSuccessHandler($referenceHandler)
            ->setSkipHandler(null)
            ->setExceptionHandler(null);

        $referenceHandler
            ->setSuccessHandler(null)
            ->setExceptionHandler(null)
            ->setSkipHandler(null);

        $this->setInitHandler($registerHandler);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws ChainHandlerException
     * @throws \Throwable
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $chainParameters = RegisterParametersBuilder::build($request);

        /** @var RegisterChainParameters $response */
        $response = $this->getInitHandler()->handle($chainParameters);

        if (!$response->isCompleted()) {
            return $this->error('Something went wrong', 500);
        }

        return $this->success([
            'user' => $response->getUser(),
            'token' => $response->getUser()->createToken('API Token')->plainTextToken
        ]);
    }
}
