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
        //Artisan::call('route:list', []);
        $response = $this->get(route('sbi-pay.payment.initiate', [123123, 1, 'test']));
        dd($response);
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
