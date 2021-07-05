<?php

/*
	 * You can place your custom package configuration in here.
	 */
return [
	/**
	 * The Merchant ID Provided by SBI
	 *
	 * You need to contact SBI to request your merchant id.
	 */
	'merchant_id' => env('SBIPAY_MERCHANT_ID'),

	/**
	 * The Merchant Seller ID
	 */
	'merchant_key' => env('SBIPAY_MERCHANT_KEY'),

	/**
	 * The Aggregator ID Provided by SBI
	 */
	'aggregator_id' => env('SBIPAY_AGGREGATOR_ID','SBIEPAY'),

	/**
	 * The Default Currency
	 *
	 * set the default currency code used for transaction.
	 */
	'currency' => env('SBIPAY_CURRENCY','INR'),

	/**
	 * indirect url used by SBI to direct the user back to your platform after a transaction is completed
	 *
	 * Example: https://localhost.test/sbi-pay/payment/callback
	 */
	'indirect_url' => env('SBIPAY_INDIRECT_URL'),

	/**
	 * The indirect url path without the domain and scheme
	 *
	 * Example: sbi-pay/payment/callback
	 */
	'indirect_path' => env('SBIPAY_INDIRECT_PATH'),

	/**
	 * Direct event url used by SBI to send direct messages to your app without the need for users actions
	 *
	 * Example: https://localhost.test/sbi-pay/payment/direct-callback
	 */
	'direct_url' => env('SBIPAY_DIRECT_URL'),

	/**
	 * The indirect url path without the domain and scheme
	 *
	 * Example: sbi-pay/payment/direct-callback
	 */
	'direct_path' => env('SBIPAY_DIRECT_PATH'),

	/**
	 * Middleware
	 */
	'middleware' => ['web'],

	/**
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
			'initiate_payment' => 'https://test.sbiepay.sbi/secure/AggregatorHostedListener',
			'initiate_refund' => 'https://test.sbiepay.sbi/secure/AggregatorRefundRequest',
			'auth_enquiry' => 'https://test.sbiepay.sbi/payagg/orderStatusQuery/getOrderStatusQuery',
		],
		'production' => [
			'initiate_payment' => 'https://test.sbiepay.sbi/secure/AggregatorHostedListener',
			'initiate_refund' => 'https://test.sbiepay.sbi/secure/AggregatorRefundRequest',
			'auth_enquiry' => 'https://test.sbiepay.sbi/payagg/orderStatusQuery/getOrderStatusQuery',
		],
	]
];
