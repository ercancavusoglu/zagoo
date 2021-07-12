<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function itShouldReturnStatusCode200WhenLoginIsAlive()
    {
        $response = $this->get('/api/login');

        $response->assertStatus(200);
    }
}
