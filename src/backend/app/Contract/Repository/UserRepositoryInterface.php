<?php

namespace App\Contract\Repository;

use App\Service\Modules\Register\Parameters\RegisterParameters;

interface UserRepositoryInterface
{
    public function save(RegisterParameters $registerParameters);
}
