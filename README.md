# SBI E Pay Integration in Laravel

This package provides laravel implementations for SBI Payment Gateway services.

## Important Notes
1. This package is still under development.
2. Your Production / Stagging server ip and domain must be whitelisted by SBI to start integration. Otherwise their Test URL will not be accessible.

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
