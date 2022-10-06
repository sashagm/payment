<?php

use Illuminate\Support\Facades\Route;

Route::get('/payment', [\Sashagm\Payment\Http\Controllers\PaymentController::class, 'index'])->name('paymentIndex');

