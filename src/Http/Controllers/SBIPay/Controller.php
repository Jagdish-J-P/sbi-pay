<?php

namespace JagdishJP\SBIPay\Http\Controllers\SBIPay;

//use App\Http\Controllers\Controller as BaseController;
use Illuminate\Routing\Controller  as BaseController;
use JagdishJP\SBIPay\Http\Requests\PaymentConfirmationRequest as Request;

class Controller extends BaseController
{
    /**
     * @param Request $request
     * @param mixed $order_no
     * @param mixed $amount
     * @param mixed $remark
     *
     * @return string
     */
    public function initiate(Request $request, $order_no = null, $amount = null, $remark = null)
    {
        return view('SBIPay::payment', compact(['order_no', 'amount', 'remark']));
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function success(Request $request)
    {
        $response = $request->handle();
        dd($response);

        // Update your order status
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
    public function webhook(Request $request)
    {
        $response = $request->handle();

        // Update your order status

        return 'OK';
    }
}
