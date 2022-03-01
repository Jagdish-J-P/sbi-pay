<?php

namespace JagdishJP\SBIPay\Tests\Feature;

use Artisan;
use JagdishJP\SBIPay\Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTheApplicationReturnsASuccessfulResponse()
    {
        Artisan::call('key:generate', []);
        $response = $this->get('/sbi-pay/initiate/payment/123123/1/test');

        $response->assertStatus(200);
    }
}
