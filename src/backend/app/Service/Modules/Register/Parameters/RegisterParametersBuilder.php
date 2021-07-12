<?php

namespace App\Service\Modules\Register\Parameters;

use App\Http\Requests\RegisterRequest;

class RegisterParametersBuilder
{
    /**
     * @param RegisterRequest $request
     * @return RegisterChainParameters
     */
    public static function build(RegisterRequest $request): RegisterChainParameters
    {
        $parameters = new RegisterParameters();
        $parameters->setName($request->get('name'));
        $parameters->setEmail($request->get('email'));
        $parameters->setPassword(bcrypt($request->get('password')));
        $parameters->setReferenceCode($request->get('reference_code', null));

        $chainParameters = new RegisterChainParameters();
        $chainParameters->setRegisterParameters($parameters);

        return $chainParameters;
    }
}
