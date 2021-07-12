<?php

namespace App\Repositories\Eloquent;

use App\Contract\Repository\InviteCodeRepositoryInterface;
use App\Models\InviteCodes;
use App\Service\Modules\Invite\Parameters\InviteParameters;
use App\Service\Modules\Register\Parameters\RegisterParameters;

class InviteCodeRepository extends BaseRepository implements InviteCodeRepositoryInterface
{
    /**
     * InviteCodeRepository constructor.
     *
     * @param InviteCodes $model
     */
    public function __construct(InviteCodes $model)
    {
        parent::__construct($model);
    }

    public function save(InviteParameters $inviteParameters)
    {
        return $this->create([

        ]);
    }

    public function check(InviteParameters $inviteParameters)
    {
        return $this->model
            ->where('user_id', '=', $inviteParameters->getUser()->id)
            ->where('code', '=', $inviteParameters->getCode())
            ->where('to', '=', $inviteParameters->getTo())
            ->first();
    }

    public function findByCode(RegisterParameters $registerParameters)
    {
        return $this->model
            ->where('code', '=', $registerParameters->getReferenceCode())
            ->where('to', '=', $registerParameters->getEmail())
            ->first();
    }

    public function updateByCode(InviteCodes $inviteCodes)
    {
        return $inviteCodes->update([
            'is_used' => 1
        ]);
    }
}
