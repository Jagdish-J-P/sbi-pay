<?php

namespace JagdishJP\SBIPay\Tests\Feature;

//use Artisan;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTheApplicationReturnsASuccessfulResponse()
    {
        //Artisan::call('key:generate', []);
        //$response = $this->get('/sbi-pay/sbi-pay/initiate/payment/123123/1/test');
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
