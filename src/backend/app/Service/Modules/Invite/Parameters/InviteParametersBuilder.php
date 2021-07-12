<?php

namespace App\Service\Modules\Invite\Parameters;

use App\Http\Requests\InviteRequest;

class InviteParametersBuilder
{
    /**
     * @param InviteRequest $request
     * @return InviteChainParameters
     */
    public static function build(InviteRequest $request): InviteChainParameters
    {
        $user = auth()->user();

        $parameters = new InviteParameters();
        $parameters->setTo($request->get('to'));
        $parameters->setCode($request->get('code'));
        $parameters->setUser($user);

        $chainParameters = new InviteChainParameters();
        $chainParameters->setInviteParameters($parameters);

        return $chainParameters;
    }
}
