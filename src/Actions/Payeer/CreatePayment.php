<?php

namespace Sashagm\Payment\Actions\Payeer;

use App\Models\User;
use Sashagm\Payment\Models\Payment;
use Sashagm\Payment\Actions\CheckBonus;
use Sashagm\Payment\Http\Requests\PaymentRequest;

class CreatePayment
{

    public function create(PaymentRequest $request)
    {
        $m_shop = config('payment.payeer.shopId');
        $m_orderid = config('payment.payeer.orderId');;
        $m_amount = number_format($request->sum, 2, '.', '');
        $m_curr = config('payment.payeer.currency');;
        $m_desc = base64_encode('Пополнение счёта для '. $request->name);
        $m_key = config('payment.payeer.secretWord');
        $order_AccountName = $request->name;
        $arHash = array(
	            $m_shop,
	            $m_orderid,
	            $m_amount,
	            $m_curr,
	            $m_desc
        );
        $arHash[] = $m_key;
        $sign = strtoupper(hash('sha256', implode(':', $arHash)));
        $arGetParams = array(
            'm_shop' => $m_shop,
            'm_orderid' => $m_orderid,
            'm_amount' => $m_amount,
            'm_curr' => $m_curr,
            'm_desc' => $m_desc,
            'm_sign' => $sign,
            );
        // Создание заявки о платеже
        $user = User::where('name', $order_AccountName)->first();
        $payment = Payment::create([
            'user_id'   =>  $user->id,
            'desc'      =>  $m_orderid,
            'sum'       =>  $m_amount,
            'provider'  =>  2,
            'status'    =>  0
        ]);
        $payment->save();
        // Редирект к платёжке payeer
        return $urlTest = config('payment.payeer.serverURL').'?'.http_build_query($arGetParams);
    }

    public function callback(CheckBonus $check,PaymentRequest $request)
    {
        // Получаем реквест с пайер
        if (!in_array($_SERVER['REMOTE_ADDR'], config('payment.payeer.serverIP'))) return;
        if (isset($request->m_operation_id) && isset($request->m_sign))
        {
            $m_key = config('payment.payeer.secretWord');
            $arHash = array(
                $request->m_operation_id,
                $request->m_operation_ps,
                $request->m_operation_date,
                $request->m_operation_pay_date,
                $request->m_shop,
                $request->m_orderid,
                $request->m_amount,
                $request->m_curr,
                $request->m_desc,
                $request->m_status
            );
            // Проверки
            if (isset($request->m_params)) { $arHash[] = $request->m_params; }
            if ($request->m_shop != config('payment.payeer.shopId')){  abort(403); }
            $arHash[] = $m_key;
            $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
            $sum =$request->m_amount;
            // Ищем заявку и пользователя 
            $payment = Payment::where('desc', $request->m_orderid)->first();
            $user = User::where('name', $payment->user_id)->first();
            $bal = $user->bonus;
            // Добавляем бонус если имеется xD
            if ($user){
                $check->getBonus($sum);
            // Узнаем статус
            if ($request->m_sign == $sign_hash && $request->m_status == 'success')
            {
                // Обновляем данные и выдаем балик на аккаунт
                $user->bonus = $bal + $sum;
                $user->save();
                $payment->initid = $request->m_operation_id;
                $payment->sum_bonus = $sum;
                $payment->status = 1; 
                $payment->save();
                ob_end_clean(); exit($request->m_orderid.'|success');
            }
            ob_end_clean(); exit($request->m_orderid.'|error');
            }
        } 
    }



}