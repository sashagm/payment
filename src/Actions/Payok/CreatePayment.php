<?php

namespace Sashagm\Payment\Actions\Payok;

use App\Models\User;
use Sashagm\Payment\Models\Payment;
use Sashagm\Payment\Actions\CheckBonus;
use Sashagm\Payment\Http\Requests\PaymentRequest;

class CreatePayment
{

    public function create(PaymentRequest $request)
    {
        $order_AccountName = $request->name;
        $array = array (
            $amount = $request->sum,
            $order_id = config('payment.payok.orderId'),
            $shop = config('payment.payok.merchantId'),
            $currency = 'RUB',
            $desc = 'Пополнение счёта для '. $order_AccountName,
            $secret = config('payment.payok.secretWord') 
        );
        
        $sign = md5(implode('|', $array));
        
        $arGetParams = [
            "amount"    => $amount,
            "payment"   => $order_id,
            "desc"      => $desc,
            "shop"      => $shop,
            "currency"  => $currency,
            "sign"      => $sign,            
            "account"   => $order_AccountName,
        ];

        $user = User::where('name', $order_AccountName)->first();
        $payment = Payment::create([
            'user_id'   =>  $user->id,
            'desc'      =>  $order_id,
            'sum'       =>  $amount,
            'provider'  =>  5,
            'status'    =>  0,
        ]);
        $payment->save();
		//	Редирект к платёжке
      
        return $urlTest = config('payment.payok.serverURL').'?'.http_build_query($arGetParams);
    }
    
    public function callback(CheckBonus $check,PaymentRequest $request)
    {
        $secret = config('payment.payok.secretWord');

        // Занесение параметров в массив
        $array = array (
            $secret,
            $desc = $request->desc,
            $currency = $request->currency,
            $shop = $request->shop,
            $payment_id = $request->peyment_id,
            $amount = $request->amount
        );
        
        // Соединение массива в строку и хеширование функцией md5
        $sign = md5 ( implode ( '|', $array ) );
        
        IF ( $sign != $request->sign ) {
        die( 'Подпись не совпадает.' );
        }
        
        $payment = Payment::where('desc', $request->payment_id)->first();        

        $user = User::where('name', $payment->user_id)->first();
        $bal = $user->bonus;
        // Добавляем бонус если имеется xD
        if ($user){
            $check->getBonus($request->amount);
            // Обновляем данные и выдаем балик на аккаунт
            $user->bonus = $bal + $request->amount;
            $user->save();
            $payment = Payment::where('desc', $request->payment_id)->first();
            $payment->initid = $request->payment_id;
            $payment->sum_bonus = $request->amount;
            $payment->status = 1; 
            $payment->save();
        }
       
    }



}    