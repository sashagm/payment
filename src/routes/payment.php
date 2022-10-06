<?php

use Illuminate\Support\Facades\Route;
/* Главная */
Route::get('/payment', [\Sashagm\Payment\Http\Controllers\PaymentController::class, 'index'])->name('paymentIndex');

/* Статусы платежей */
Route::get('/payment/success', [\Sashagm\Payment\Http\Controllers\PaymentController::class, 'success'])->name('paymentSuccess');
Route::get('/payment/fail', [\Sashagm\Payment\Http\Controllers\PaymentController::class, 'fail'])->name('paymentFail');

/* Обработка форм */
Route::post('/payment/freekassa_form', [\Sashagm\Payment\Http\Controllers\PaymentFreekassaController::class, 'freekassaForm'])->name('freekassaForm');
Route::post('/payment/payeer_form', [\Sashagm\Payment\Http\Controllers\PaymentPayeerController::class, 'payeerForm'])->name('payeerForm');
Route::post('/payment/webmoney_form', [\Sashagm\Payment\Http\Controllers\PaymentWebmoneyController::class, 'webmoneyForm'])->name('webmoneyForm');


