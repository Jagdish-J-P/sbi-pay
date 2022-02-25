<?php

use App\Http\Controllers\SBIPay\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use JagdishJP\SBIPay\Http\Controllers\PaymentController;

$failPath    = Config::get('sbipay.fail_path');
$successPath = Config::get('sbipay.success_path');
$webhookPath = Config::get('sbipay.webhook_path');

Route::get('sbi-pay/initiate/payment/{order_no}/{amount}/{remark}', function ($order_no, $amount, $remark) {
    return view('SBIPay::payment', compact(['order_no', 'amount', 'remark']));
})->name('sbi-pay.initiate.payment');

Route::post('payment/sbi-pay/auth', [PaymentController::class, 'handle'])->name('sbi-pay.payment.auth.request');
Route::get('payment/initiate/sbi-pay/{order_no}/{amount}/{remark}', [Controller::class, 'initiate'])->name('sbi-pay.payment.initiate');
Route::post($webhookPath, [Controller::class, 'webhook'])->name('sbi-pay.payment.webhook');
Route::post($successPath, [Controller::class, 'success'])->name('sbi-pay.payment.success.callback');
Route::post($failPath, [Controller::class, 'fail'])->name('sbi-pay.payment.fail.callback');
