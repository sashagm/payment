<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
   
/* Главная */
Route::get('/payment', [\Sashagm\Payment\Http\Controllers\PaymentController::class, 'index'])->name('paymentIndex');

/* Статусы платежей */
Route::get('/payment/success', [\Sashagm\Payment\Http\Controllers\PaymentController::class, 'success'])->name('paymentSuccess');
Route::get('/payment/fail', [\Sashagm\Payment\Http\Controllers\PaymentController::class, 'fail'])->name('paymentFail');

/* Обработка форм */
Route::post('/payment/freekassa_form', [\Sashagm\Payment\Http\Controllers\PaymentFreekassaController::class, 'freekassaForm'])->name('freekassaForm');
Route::post('/payment/payeer_form', [\Sashagm\Payment\Http\Controllers\PaymentPayeerController::class, 'payeerForm'])->name('payeerForm');
Route::post('/payment/webmoney_form', [\Sashagm\Payment\Http\Controllers\PaymentWebmoneyController::class, 'webmoneyForm'])->name('webmoneyForm');

/* Получение ответа */
Route::post('/payment/freekassa', [\Sashagm\Payment\Http\Controllers\PaymentFreekassaController::class, 'freekassa'])->name('freekassa');
Route::post('/payment/payeer', [\Sashagm\Payment\Http\Controllers\PaymentPayeerController::class, 'payeer'])->name('payeer');



});
