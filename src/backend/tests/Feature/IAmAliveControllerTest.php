<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use PHPUnit\Framework\TestCase;

class IAmAliveControllerTest extends TestCase
{
    /**
     * @test
     * @covers ::handle
     */
    public function itShouldReturnStatusCode200WhenMicroIsAlive()
    {
        $response = $this->get('/api/i-am-alive');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
