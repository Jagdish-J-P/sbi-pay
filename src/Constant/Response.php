<?php

namespace JagdishJP\SBIPay\Constant;

class Response
{
    /** constant to name response parameters */
    public const RESPONSE_PARAMETERS = [
        // Merchant Reference Order no
        'merchant_order_no',

        // SBI Transactin ID
        'sbi_transaction_id',

        // Transaction status [SUCCESS, FAIL, PENDING]
        'transaction_status',

        // Transaction Amount
        'amount',

        // Currency code
        'currency',

        // Payment Mode [IMPS, NB, CC, DC]
        'pay_mode',

        // Extra details sent while initiating transaction
        'extra_details',

        // Reason for transaction failure
        'reason',

        // Bank code
        'bank_code',

        // Bank reference number
        'bank_reference_number',

        // Transaction date (Format: Y-m-d H:i:s)
        'transaction_date',

        // Country code
        'country',

        /*
            Challan Identification number generated for Government merchant.
            Format:
            MerchantID (7CHAR)+date
            YYYYMMDD (8 CHAR)+running
            number(5 CHAR). It will be
            generated only for successful
            transactions. For failed
            transaction, its value would be
            “NA”
        */
        'CIN',

        // Merchant Id
        'merchant_id',

        // Transaction Fees charged by bank including GST
        'total_fees',

        // Reserved fields for future purpose [ref1 - ref9]
        'ref1',
        'ref2',
        'ref3',
        'ref4',
        'ref5',
        'ref6',
        'ref7',
        'ref8',
        'ref9',
    ];

    /** constant to name response parameters of status */
    public const RESPONSE_PARAMETERS_STATUS = [
        // Merchant Reference Order no
        'merchant_id',

        // SBI Transactin ID
        'sbi_transaction_id',

        // Transaction status [SUCCESS, FAIL, PENDING]
        'transaction_status',

        // Country Code
        'country',

        // Currency code
        'currency',
        
        // Extra details sent while initiating transaction
        'extra_details',

        // Merchant Reference Order no
        'merchant_order_no',
        
        // Transaction Amount
        'amount',
        
        // Reason for transaction failure
        'reason',

        // Bank code
        'bank_code',

        // Bank reference number
        'bank_reference_number',

        // Transaction date (Format: Y-m-d H:i:s)
        'transaction_date',

        // Payment Mode [IMPS, NB, CC, DC]
        'pay_mode',

        /*
            Challan Identification number generated for Government merchant.
            Format:
            MerchantID (7CHAR)+date
            YYYYMMDD (8 CHAR)+running
            number(5 CHAR). It will be
            generated only for successful
            transactions. For failed
            transaction, its value would be
            “NA”
        */
        'CIN',

        // Merchant Id
        'merchant_id',

        // Transaction Fees charged by bank including GST
        'total_fees',

        // Reserved fields for future purpose [ref1 - ref9]
        'ref1',
        'ref2',
        'ref3',
        'ref4',
        'ref5',
        'ref6',
        'ref7',
        'ref8',
        'ref9',
        'na',
    ];
}
