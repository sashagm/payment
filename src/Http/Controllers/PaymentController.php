<?php

namespace Sashagm\Payment\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        //dd(config('payment'));
        if (config('payment.general.isService') == true) {
            return view('payment::index');
        } else abort(403);
       
    }

    public function success()
    {
        return view('payment::success');
    }
    public function fail()
    {
        return view('payment::fail');
    }
}
