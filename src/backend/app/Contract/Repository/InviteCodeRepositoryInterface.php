<?php

namespace App\Contract\Repository;

use App\Models\InviteCodes;
use App\Service\Modules\Invite\Parameters\InviteParameters;
use App\Service\Modules\Register\Parameters\RegisterParameters;

interface InviteCodeRepositoryInterface
{
    public function save(InviteParameters $inviteParameters);

    public function check(InviteParameters $inviteParameters);

    public function findByCode(RegisterParameters $registerParameters);

    public function updateByCode(InviteCodes $inviteCodes);

}
