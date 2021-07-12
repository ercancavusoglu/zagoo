<?php

namespace App\Repositories\Eloquent;

use App\Contract\Repository\UserRepositoryInterface;
use App\Models\User;
use App\Service\Modules\Register\Parameters\RegisterParameters;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function save(RegisterParameters $registerParameters)
    {
        return $this->create([
            'name' => $registerParameters->getName(),
            'email' => $registerParameters->getEmail(),
            'password' => $registerParameters->getPassword(),
            'reference_code' => uniqid()
        ]);
    }
}
