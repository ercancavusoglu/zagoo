<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IAmAliveController
{
    public function handle()
    {
        return new JsonResponse('OK', Response::HTTP_OK);
    }
}
