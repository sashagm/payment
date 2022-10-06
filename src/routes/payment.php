<?php

use Illuminate\Support\Facades\Route;

Route::get('/payment', [\Sashagm\Payment\Http\Controllers\PaymentController::class, 'index'])->name('paymentIndex');

Route::get('/payment/success', [\Sashagm\Payment\Http\Controllers\PaymentController::class, 'success'])->name('paymentSuccess');
Route::get('/payment/fail', [\Sashagm\Payment\Http\Controllers\PaymentController::class, 'fail'])->name('paymentFail');



