<?php

use App\Http\Controllers\SBIPay\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use JagdishJP\SBIPay\Http\Controllers\PaymentController;

$failPath    = Config::get('sbipay.fail_path');
$successPath = Config::get('sbipay.success_path');
$webhookPath = Config::get('sbipay.webhook_path');

Route::view('sbi-pay/initiate/payment', 'SBIPay::payment')->name('sbi-pay.initiate.payment');
Route::post('payment/sbi-pay/auth', [PaymentController::class, 'handle'])->name('sbi-pay.payment.auth.request');
Route::post($webhookPath, [Controller::class, 'webhook'])->name('sbi-pay.payment.webhook');
Route::post($successPath, [Controller::class, 'success'])->name('sbi-pay.payment.success.callback');
Route::post($failPath, [Controller::class, 'fail'])->name('sbi-pay.payment.fail.callback');
