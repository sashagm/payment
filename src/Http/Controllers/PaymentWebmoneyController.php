<?php

namespace Sashagm\Payment\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Sashagm\Payment\Models\Payment;
use Sashagm\Payment\Actions\CheckBonus;
use Sashagm\Payment\Actions\ActiveService;
use Sashagm\Payment\Http\Requests\PaymentRequest;
use Sashagm\Payment\Actions\Webmoney\CreatePayment;

class PaymentWebmoneyController extends Controller
{
    public function webmoneyForm(ActiveService $service, CreatePayment $pay, PaymentRequest $request)
    {
        $service->active(config('payment.webmoney.active'));
        return redirect($pay->create($request));
    }

    public function webmoney(CreatePayment $pay, CheckBonus $check, PaymentRequest $request)
    {
        $pay->callback($check, $request);
    }

     
}

