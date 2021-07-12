<?php

namespace App\Service\Modules\Common;

abstract class AbstractManager
{
    /**
     * @var AbstractChainHandler
     */
    protected $initHandler;

    public function getInitHandler()
    {
        return $this->initHandler;
    }

    public function setInitHandler(AbstractChainHandler $initHandler): self
    {
        $this->initHandler = $initHandler;

        return $this;
    }
}
