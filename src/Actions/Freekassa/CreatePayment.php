<?php

namespace Sashagm\Payment\Actions\Freekassa;

use App\Models\User;
use Sashagm\Payment\Models\Payment;
use Sashagm\Payment\Actions\CheckBonus;
use Sashagm\Payment\Http\Requests\PaymentRequest;

class CreatePayment
{

    public function create(PaymentRequest $request)
    {
        // Конфиги и подписание хэша
        $serverURL = config('payment.freekassa.serverURL');
        $merchant_id = config('payment.freekassa.merchantId');
        $secret_word = config('payment.freekassa.secretWord');
        $lang = config('payment.freekassa.lang');
        $order_amount = $request->sum;
		$order_id = config('payment.freekassa.orderId');
		$order_AccountName = $request->name;
		$currency = config('payment.freekassa.currency');
		$sigShop = md5($merchant_id.":".$order_amount.":".$secret_word.":".$currency.":".$order_id);
        // Создание заявки о платеже
        $user = User::where('name', $order_AccountName)->first();
        $payment = Payment::create([
            'user_id'   =>  $user->id,
            'desc'      =>  $order_id,
            'sum'       =>  $order_amount,
            'provider'  =>  1,
            'status'    =>  0
        ]);
        $payment->save();
		//	Редирект к платёжке фрикасса
        return $urlTest = $serverURL."?m=".$merchant_id."&oa=".$order_amount."&o=".$order_id."&currency=".$currency."&s=".$sigShop."&lang=".$lang."&us_AccountName=".$order_AccountName;
  
    }

    public function callback(CheckBonus $check,PaymentRequest $request)
    {
        // Получаем реквест с фрикассы
        $merchant_id = config('payment.freekassa.merchantId');
        $secret_word = config('payment.freekassa.secretWord');
        $sum = $request->AMOUNT;
        $accName = $request->us_AccountName;
        $desc = $request->MERCHANT_ORDER_ID;
        $initid = $request->initid;
        $sigShop = md5($merchant_id.":".$sum.":".$secret_word.":".$desc);
        // Проверки
        if (!in_array($this->getIP(), config('payment.freekassa.serverIP'))) { abort(403); }
        if ($sigShop != $request->SIGN) { abort(403);  }
        // Ищем пользователя 
        $user = User::where('name', $accName)->first();
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
        //Обязательный момент фрикассы
        die('YES'); 
    }

    public function getIP()
    {
        if(isset($_SERVER['HTTP_X_REAL_IP'])){
            return $_SERVER['HTTP_X_REAL_IP'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }    

}