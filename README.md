# SBI E Pay Integration in Laravel

This package provides laravel implementations for SBI Payment Gateway services.

## Become a sponsor

[![](.github/assets/support.png)](https://github.com/sponsors/Jagdish-J-P)

Your support allows me to keep this package free, up-to-date and maintainable. Alternatively, you can **[spread the word!](http://twitter.com/share?text=I+am+using+this+cool+PHP+package+to+integrate+sbi+payment+gateway&url=https://github.com/jagdish-j-p/sbi-pay&hashtags=PHP,Laravel,SBIEPay)**

## Important Notes
1. Your Production / Stagging server ip and domain must be whitelisted by SBI to start integration. Otherwise their Test URL will not be accessible.

## Installation

You can install the package via composer:

```bash
composer require jagdish-j-p/sbi-pay
```
Then run the publish command to publish the config files and other supported files

```bash
php artisan sbi-pay:publish
```

This will generate the following files

- The config file with default setup for you to override `sbipay.php`
- The controller that will receive payment response and any host-to-host events `app/Http/Controllers/SBIPay/Controller.php`
- The assets in public directory.
- The view file with default html for you to override `payment.blade.php`. Note do not change form action URL `sbi-pay.payment.auth.request`.

## Set-Up

1. Add your redirect urls and your Credentials provided by SBI to the `.env` file.

```php
SBIEPAY_ACCOUNT_IDENTIFIER=NEFT
SBIEPAY_AGGREGATOR_ID=SBIEPAY
SBIEPAY_MERCHANT_ID=
SBIEPAY_MERCHANT_KEY=

SBIEPAY_SUCCESS_PATH="sbi-pay/payment/success"
SBIEPAY_FAIL_PATH="sbi-pay/payment/fail"

SBIEPAY_SUCCESS_URL="${APP_URL}/${SBIEPAY_SUCCESS_PATH}"
SBIEPAY_FAIL_URL="${APP_URL}/${SBIEPAY_FAIL_PATH}"
```

You can override the defaults by updating the config file.



## Usage

1. You can visit <a href='https://app.test/sbi-pay/initiate/payment'>https://app.test/sbi-pay/initiate/payment</a> for the payment flow demo of web integration. You can override below function defined in `app/Http/Controllers/SBIPay/Controller.php` as per your requirement.

```php
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
```
You can also override `payment.blade.php` with your custom design to integrate with your layout. but do not change `name` attribute of html controls and `action` URL of form.


2. Handle the payment response in `app/Http/Controllers/SBIPay/Controller.php`

```php

    /**
     * Handles payment success response
     * @param Request $request
     *
     * @return Response
     */
    public function success(Request $request)
    {
        $response = $request->handle();

        // Update your order status
    }

    /**
     * Handles payment fail response
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
     * Handles server-to-server communication
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
```

3. View Transaction Status

```
https://app.test/sbi-pay/transaction/status/$sbi_transaction_id/$merchant_order_no
```

4. Check transaction status or Initiate Refund from Controller

```php

use JagdishJP\SBIPay\Facades\SBIPay;

/**
 * Returns status of transaction
 *
 * @param string $sbi_transaction_id sbi transaction id
 * @param string $merchant_order_no  merchant order no
 * @return array
 */
$status = SBIPay::transactionStatus($sbi_transaction_id, $merchant_order_no);


/**
 * Initiates refund for any transaction
 *
 * @param string $sbi_transaction_id sbi transaction id
 * @param string $refund_order_no    refund order no
 * @param string $amount             amount to refund partial/full
 * @param string $merchant_order_no  merchant order no
 * @return array
 */
$banks = SBIPay::initiateRefund($sbi_transaction_id, $refund_order_no, $amount, $merchant_order_no);

```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email jagdish.j.ptl@gmail.com instead of using the issue tracker.

## Credits

- [Jagdish-J-P](https://github.com/jagdish-j-p)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
