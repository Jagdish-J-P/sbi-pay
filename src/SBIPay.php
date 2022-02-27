<?php

namespace JagdishJP\SBIPay;

use JagdishJP\SBIPay\Messages\TransactionStatusMessage;

class SBIPay
{
    public function transactionStatus(string $sbi_transaction_id, string $merchant_order_no)
    {
        $transactionStatus = (new TransactionStatusMessage())->handle(compact('sbi_transaction_id', 'merchant_order_no'));

        return $transactionStatus->get();
    }
}
