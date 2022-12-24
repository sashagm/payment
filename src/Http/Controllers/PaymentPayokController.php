<?php

namespace Sashagm\Payment\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Sashagm\Payment\Models\Payment;
use Sashagm\Payment\Actions\CheckBonus;
use Sashagm\Payment\Actions\ActiveService;
use Sashagm\Payment\Actions\Payok\CreatePayment;
use Sashagm\Payment\Http\Requests\PaymentRequest;

class PaymentPayokController extends Controller
{
    public function payokForm(ActiveService $service, CreatePayment $pay, PaymentRequest $request)
    {
        $service->active(config('payment.payok.active'));
        return redirect($pay->create($request));
    }

    public function payok(CreatePayment $pay, CheckBonus $check, PaymentRequest $request)
    {
        $pay->callback($check, $request);
    }      



}
