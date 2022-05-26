<?php

// You can place your custom package configuration in here.
return [
    /*
     * The Merchant ID Provided by SBI
     *
     * You need to contact SBI to request your merchant id.
     */
    'merchant_id' => env('SBIEPAY_MERCHANT_ID'),

    // The Merchant Seller ID
    'merchant_key' => env('SBIEPAY_MERCHANT_KEY'),

    // The Aggregator ID Provided by SBI
    'aggregator_id' => env('SBIEPAY_AGGREGATOR_ID', 'SBIEPAY'),

    // The Aggregator ID Provided by SBI
    'account_identifier' => env('SBIEPAY_ACCOUNT_IDENTIFIER', ''),

    /*
     * The Default Currency
     *
     * set the default currency code used for transaction.
     */
    'currency' => env('SBIEPAY_CURRENCY', 'INR'),

    /*
     * The Default Country
     *
     * set the default currency code used for transaction.
     */
    'country' => env('SBIEPAY_COUNTRY', 'IN'),

    /*
     * Operating Mode
     *
     * set the default Operating Mode used for transaction.
     */
    'operating_mode' => env('SBIEPAY_OPERATING_MODE', 'DOM'),

    /*
     * The success url path without the domain and scheme
     *
     * Example: sbi-e-pay/payment/success
     */
    'success_path' => env('SBIEPAY_SUCCESS_PATH'),

    /*
     * Success url used by SBI to direct the user back to your platform after a transaction is completed
     *
     * Example: https://localhost.test/sbi-e-pay/payment/success
     */
    'success_url' => env('SBIEPAY_SUCCESS_URL', env('APP_URL') . '/' . env('SBIEPAY_SUCCESS_PATH')),

    /*
     * Fail url path without the domain and scheme
     *
     * Example: sbi-e-pay/payment/fail
     */
    'fail_path' => env('SBIEPAY_FAIL_PATH'),

    /*
     * Fail url used by SBI to direct the user back to your platform after a transaction is failed
     *
     * Example: https://localhost.test/sbi-e-pay/payment/fail
     */
    'fail_url' => env('SBIEPAY_FAIL_URL', env('APP_URL') . '/' . env('SBIEPAY_FAIL_PATH')),

    /*
     * Webhook path without the domain and scheme
     *
     * Example: sbi-e-pay/payment/fail
     */
    'webhook_path' => env('SBIEPAY_WEBHOOK_PATH'),

    /*
     * Webhook url used by SBI to make server-to-server communication to update status
     *
     * Example: https://localhost.test/sbi-e-pay/payment/webhook
     */
    'webhook_url' => env('SBIEPAY_WEBHOOK_URL', env('APP_URL') . '/' . env('SBIEPAY_WEBHOOK_PATH')),

    // Middleware
    'middleware' => ['web'],

    /*
     * Urls List
     *
     * the list of urls for uat and production
     *
     * each url is used for a specific request, please refer to documentation to learn more about when to use
     * each url.
     *
     */
    'urls' => [
        'uat' => [
            'initiate_payment'   => 'https://test.sbiepay.sbi/secure/AggregatorHostedListener',
            'initiate_refund'    => 'https://test.sbiepay.sbi/payagg/bookRefundCancellation/AggStandardEncRefundQueryService',
            'transaction_status' => 'https://test.sbiepay.sbi/payagg/orderStatusQuery/getOrderStatusQuery',
        ],
        'production' => [
            'initiate_payment'   => 'https://test.sbiepay.sbi/secure/AggregatorHostedListener',
            'initiate_refund'    => 'https://test.sbiepay.sbi/payagg/bookRefundCancellation/AggStandardEncRefundQueryService',
            'transaction_status' => 'https://test.sbiepay.sbi/payagg/orderStatusQuery/getOrderStatusQuery',
        ],
    ],
];
