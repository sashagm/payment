<?php

namespace Sashagm\Payment\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Sashagm\Payment\Models\Payment;
use Sashagm\Payment\Actions\CheckBonus;
use Sashagm\Payment\Actions\ActiveService;
use Sashagm\Payment\Actions\Payeer\CreatePayment;
use Sashagm\Payment\Http\Requests\PaymentRequest;

class PaymentPayeerController extends Controller
{
    public function payeerForm(ActiveService $service, CreatePayment $pay, PaymentRequest $request)
    {
        $service->active(config('payment.PAYEER_active'));
        return redirect($pay->create($request));
    }

    public function payeer(CreatePayment $pay, CheckBonus $check, PaymentRequest $request)
    {
        $pay->callback($check, $request);
    }      



}
