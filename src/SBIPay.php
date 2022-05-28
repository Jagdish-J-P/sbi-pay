<?php

namespace JagdishJP\SBIPay;

use JagdishJP\SBIPay\Messages\Message;
use JagdishJP\SBIPay\Messages\RefundRequestMessage;
use JagdishJP\SBIPay\Messages\TransactionStatusMessage;

class SBIPay
{
    public static function initiateRefund(string $refund_order_no, string $sbi_transaction_id, int $refund_amount, string $merchant_order_no)
    {
        $refundRequest = (new RefundRequestMessage())
            ->handle(compact('refund_order_no', 'sbi_transaction_id', 'refund_amount', 'merchant_order_no'));

        return $refundRequest->post();
    }

    public static function encrypt($data)
    {
        return resolve(Message::class)->encrypt($data);
    }

    public static function decrypt($cipherText)
    {
        return resolve(Message::class)->decrypt($cipherText, true);
    }

    public function transactionStatus(string $sbi_transaction_id, string $merchant_order_no)
    {
        $transactionStatus = (new TransactionStatusMessage())->handle(compact('sbi_transaction_id', 'merchant_order_no'));

        return $transactionStatus->get();
    }
}
