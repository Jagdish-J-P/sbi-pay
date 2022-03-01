<?php

namespace JagdishJP\SBIPay\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JagdishJP\SBIPay\Facades\SBIPay;
use JagdishJP\SBIPay\Http\Requests\PaymentRequest;
use JagdishJP\SBIPay\Messages\PaymentRequestMessage;

class PaymentController extends Controller
{
    /**
     * Initiate the request for payment to SBI.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function handle(PaymentRequest $request)
    {
        return view('SBIPay::redirect_to_bank', [
            'request' => (new PaymentRequestMessage())->handle($request->all()),
        ]);
    }

    public function getTransactionStatus($sbi_transaction_id, $merchant_order_no)
    {
        return SBIPay::transactionStatus($sbi_transaction_id, $merchant_order_no);
    }
}
