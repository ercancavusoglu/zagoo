<?php

namespace App\Service\Modules\Common;

use App\Exceptions\ChainHandlerException;
use App\Service\Modules\Common\ChainParameters\ChainParametersInterface;

/**
 * Class AbstractStrategy.
 */
abstract class AbstractChainHandler
{
    /**
     * @var AbstractChainHandler|null
     */
    private $successHandler;

    /**
     * @var AbstractChainHandler|null
     */
    private $exceptionHandler;

    /**
     * @var AbstractChainHandler|null
     */
    private $skipHandler;

    public function handle(ChainParametersInterface $chainParameters)
    {
        $chainParameters->chain = static::class;

        try {
            if (!$this->isProcessable($chainParameters)) {
                if ($this->getSkipHandler()) {
                    return $this->getSkipHandler()->handle($chainParameters);
                }

                if (!$chainParameters->isCompleted()) {
                    throw new ChainHandlerException('[' . static::class . ']Handler completed wrongly');
                }

                return $chainParameters;
            }

            $this->process($chainParameters);

            if ($this->getSuccessHandler()) {
                return $this->getSuccessHandler()->handle($chainParameters);
            }

            if (!$chainParameters->isCompleted()) {
                throw new ChainHandlerException('[' . static::class . ']Handler completed wrongly');
            }

            return $chainParameters;
        } catch (\Throwable $exception) {
            if (static::class !== $chainParameters->chain) {
                throw $exception;
            }

            $chainParameters->setLastException($exception);

            if ($this->getExceptionHandler()) {
                return $this->getExceptionHandler()->handle($chainParameters);
            }

            throw $exception;
        }
    }

    public function isProcessable(ChainParametersInterface $chainParameters): bool
    {
        return true;
    }

    abstract public function process(ChainParametersInterface $chainParameters);

    public function getSuccessHandler(): ?AbstractChainHandler
    {
        return $this->successHandler;
    }

    public function setSuccessHandler(?AbstractChainHandler $successHandler): AbstractChainHandler
    {
        $this->successHandler = $successHandler;

        return $this;
    }

    public function getExceptionHandler(): ?AbstractChainHandler
    {
        return $this->exceptionHandler;
    }

    public function setExceptionHandler(?AbstractChainHandler $exceptionHandler): AbstractChainHandler
    {
        $this->exceptionHandler = $exceptionHandler;

        return $this;
    }

    public function getSkipHandler(): ?AbstractChainHandler
    {
        return $this->skipHandler;
    }

    public function setSkipHandler(?AbstractChainHandler $skipHandler): AbstractChainHandler
    {
        $this->skipHandler = $skipHandler;

        return $this;
    }
}
