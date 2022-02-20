<?php

namespace App\Http\Controllers\SBIPay;

use App\Http\Controllers\Controller as BaseController;
use JagdishJP\SBIPay\Http\Requests\PaymentConfirmationRequest as Request;

class Controller extends BaseController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function callback(Request $request)
    {
        $response = $request->handle();

        // Update your order status
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function webhook(Request $request)
    {
        $response = $request->handle();

        // Update your order status

        return 'OK';
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function fail(Request $request)
    {
        $response = $request->handle();

        // Update your order status

        return 'OK';
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function fail(Request $request)
    {
        $response = $request->handle();

        // Update your order status

        return 'OK';
    }
}
