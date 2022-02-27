<?php

namespace JagdishJP\SBIPay\Services;

use JagdishJP\SBIPay\Messages\TransactionStatusMessage;

class TransactionService
{
    public function status($sbiTransactionId, $merchantOrderNo)
    {
        $transactionStatus = new TransactionStatusMessage();
    }
}
