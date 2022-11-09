<?php

namespace Sashagm\Payment\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Sashagm\Payment\Models\Payment;
use Sashagm\Payment\Actions\CheckBonus;
use Sashagm\Payment\Actions\ActiveService;
use Sashagm\Payment\Actions\Freekassa\CreatePayment;
use Sashagm\Payment\Http\Requests\PaymentRequest;

class PaymentFreekassaController extends Controller
{
    public function freekassaForm(ActiveService $service, CreatePayment $pay, PaymentRequest $request)
    {
        $service->active(config('payment.freekassa.active'));
        return redirect($pay->create($request));
    }

    public function freekassa(CreatePayment $pay, CheckBonus $check, PaymentRequest $request)
    {
        $pay->callback($check, $request);
    }


}
