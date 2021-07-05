<?php

use JagdishJP\SBIPay\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SBIPay\Controller;

$directPath = Config::get('sbi-pay.direct_path');
$indirectPath = Config::get('sbi-pay.indirect_path');

Route::view('sbi-pay/initiate/payment','sbi-pay::payment')->name('sbi-pay.initiate.payment');
Route::post('payment/sbi-pay/auth', [PaymentController::class, 'handle'])->name('sbi-pay.payment.auth.request');
Route::post($directPath, [Controller::class, 'webhook'])->name('sbi-pay.payment.direct.callback');
Route::post($indirectPath, [Controller::class, 'callback'])->name('sbi-pay.payment.indirect.callback');
