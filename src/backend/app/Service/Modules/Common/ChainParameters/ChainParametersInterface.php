<?php

namespace App\Service\Modules\Common\ChainParameters;

interface ChainParametersInterface
{
    public function isCompleted(): bool;

    public function setLastException(\Throwable $exception): self;

    public function getLastException(): ?\Throwable;
}
