<?php

namespace Sashagm\Payment\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Sashagm\Payment\Models\Payment;
use Sashagm\Payment\Actions\CheckBonus;
use Sashagm\Payment\Actions\ActiveService;
use Sashagm\Payment\Actions\Litekassa\CreatePayment;
use Sashagm\Payment\Http\Requests\PaymentRequest;

class PaymentLitekassaController extends Controller
{
    public function litekassaForm(ActiveService $service, CreatePayment $pay, PaymentRequest $request)
    {
        $service->active(config('payment.litekassa.active'));
        return redirect($pay->create($request));
    }

    public function litekassa(CreatePayment $pay, CheckBonus $check, PaymentRequest $request)
    {
        $pay->callback($check, $request);
    }      



}
