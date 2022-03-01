<?php

namespace JagdishJP\SBIPay\Tests\Feature;

use JagdishJP\SBIPay\Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTheApplicationReturnsASuccessfulResponse()
    {
        $this->withoutMiddleware();
        
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
