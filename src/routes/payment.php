<?php

use Illuminate\Support\Facades\Route;
use Sashagm\Payment\Http\Controllers\PaymentController;
use Sashagm\Payment\Http\Controllers\PaymentPayeerController;
use Sashagm\Payment\Http\Controllers\PaymentWebmoneyController;
use Sashagm\Payment\Http\Controllers\PaymentFreekassaController;

Route::group(['middleware' => ['web']], function () {
   
/* Главная */
Route::get('/payment', [PaymentController::class, 'index'])->name('paymentIndex');

/* Статусы платежей */
Route::get('/payment/success', [PaymentController::class, 'success'])->name('paymentSuccess');
Route::get('/payment/fail', [PaymentController::class, 'fail'])->name('paymentFail');

/* Обработка форм */
Route::post('/payment/freekassa_form', [PaymentFreekassaController::class, 'freekassaForm'])->name('freekassaForm');
Route::post('/payment/payeer_form', [PaymentPayeerController::class, 'payeerForm'])->name('payeerForm');
Route::post('/payment/webmoney_form', [PaymentWebmoneyController::class, 'webmoneyForm'])->name('webmoneyForm');

/* Получение ответа */
Route::post('/payment/freekassa', [PaymentFreekassaController::class, 'freekassa'])->name('freekassa');
Route::post('/payment/payeer', [PaymentPayeerController::class, 'payeer'])->name('payeer');



});
