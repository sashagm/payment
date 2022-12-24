<?php

namespace Sashagm\Payment\Actions\Litekassa;

use App\Models\User;
use Sashagm\Payment\Models\Payment;
use Sashagm\Payment\Actions\CheckBonus;
use Sashagm\Payment\Http\Requests\PaymentRequest;

class CreatePayment
{

    public function create(PaymentRequest $request)
    {
        // Конфиги и подписание хэша
        $shop_id = config('payment.litekassa.merchantId');
        $secret = config('payment.litekassa.secretWord');
        $order_id = config('payment.litekassa.orderId');
        $order_amount = $request->sum;
        $order_AccountName = $request->name;
        $desc = 'Пополнение счёта для '. $request->name;
        $sign = md5($shop_id.':'.$order_amount.':'.$secret.':'.$order_id);
        $arGetParams = [
            "shop"  => $shop_id,
            "order" => $order_id,
            "amount" => $order_amount,
            "sign"  => $sign,
            "desc"  => $desc
        ];

        $user = User::where('name', $order_AccountName)->first();
        $payment = Payment::create([
            'user_id'   =>  $user->id,
            'desc'      =>  $order_id,
            'sum'       =>  $order_amount,
            'provider'  =>  4,
            'status'    =>  0,
        ]);
        $payment->save();
		//	Редирект к платёжке 

        return $urlTest = config('payment.litekassa.serverURL').'?'.http_build_query($arGetParams);


    }

    public function callback(CheckBonus $check,PaymentRequest $request)
    {
        //Секретное слово
        $secret = config('payment.litekassa.secretWord');
        $merchant_id = $request->SHOP_ID;
        $sum = $request->AMOUNT;
        $desc = $request->ORDER_ID;
        $initid = $request->INV_ID;
        $key = $request->SIGN;
        $sign = md5($merchant_id.':'.$sum.':'.$secret.':'.$desc);

        if (!in_array(self::getIP(), json_decode(file_get_contents('https://www.lite-kassa.ru/ips.json'), true))) {
            die("hacking attempt!");
        }
 

        if ($sign != $key) {
            die("wrong sign");
        }

        //Так же, рекомендуется добавить проверку на сумму платежа и не была ли эта заявка уже оплачена или отменена
        //Оплата прошла успешно, можно проводить операцию.
        // Ищем пользователя 

        $payment = Payment::where('desc', $desc)->first();        

        $user = User::where('name', $payment->user_id)->first();
        $bal = $user->bonus;
        // Добавляем бонус если имеется xD
        if ($user){
            $check->getBonus($sum);
            // Обновляем данные и выдаем балик на аккаунт
            $user->bonus = $bal + $sum;
            $user->save();
            $payment = Payment::where('desc', $desc)->first();
            $payment->initid = $initid;
            $payment->sum_bonus = $sum;
            $payment->status = 1; 
            $payment->save();
        }

        die('OK');
    }



    function getIP() {
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) return $_SERVER['HTTP_CF_CONNECTING_IP'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
        return $_SERVER['REMOTE_ADDR'];
    }

}    