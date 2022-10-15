<?php

namespace Sashagm\Payment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Sashagm\Payment\Models\Payment;
use App\Models\User;

class PaymentPayeerController extends Controller
{
    public function payeerForm(Request $request)
    {
        // Валидация
        $messages = [
            'name.required'     => 'Вы не указали логин.',
            'name.exists'       => 'Указанный логин не найден.',
            'name.string'       => 'Поле логин должен быть строкой.',
            'sum.required'      => 'Вы не указали сумму.',
            'sum.numeric'       => 'Поле сумма должно быть число.',
            'sum.min'           => 'Поле сумма должно быть больше ' . config('payment.minSum'),
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|exists:users|max:255',
            'sum' => 'required|numeric|min:'. config('payment.minSum'),
        ], $messages);
        // Получить проверенные данные...
        $validated = $validator->validated();
        $m_shop = config('payment.PAYEER_shopId');
        $m_orderid = config('payment.PAYEER_orderId');;
        $m_amount = number_format($request->sum, 2, '.', '');
        $m_curr = config('payment.PAYEER_currency');;
        $m_desc = base64_encode('Пополнение счёта для '. $request->name);
        $m_key = config('payment.PAYEER_secretWord');
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
        return redirect(config('payment.PAYEER_serverURL').'?'.http_build_query($arGetParams));

    }

    public function payeer(Request $request)
    {
        // Получаем реквест с пайер
        if (!in_array($_SERVER['REMOTE_ADDR'], config('payment.PAYEER_serverIP'))) return;
        if (isset($request->m_operation_id) && isset($request->m_sign))
        {
            $m_key = config('payment.PAYEER_secretWord');
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
            if ($request->m_shop != config('payment.PAYEER_shopId')){  abort(403); }
            $arHash[] = $m_key;
            $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
            $sum =$request->m_amount;
            // Ищем заявку и пользователя 
            $payment = Payment::where('desc', $request->m_orderid)->first();
            $user = User::where('name', $payment->user_id)->first();
            $bal = $user->bonus;
            // Добавляем бонус если имеется xD
            if ($user){
            if($sum > 499 AND $sum < 1000 ){
                $sum = self::percent_rate($sum, 5); //от 500 +5%
            }
            elseif($sum > 999 AND $sum < 2000 ){
                $sum = self::percent_rate($sum, 10); //от 1к +10%
            }
            elseif($sum > 1999 AND $sum < 3500 ){
                $sum = self::percent_rate($sum, 15); //от 2к +15%
            }
            elseif($sum > 3499 AND $sum < 5000 ){
                $sum = self::percent_rate($sum, 20); //от 2к +20%
            }
            elseif($sum > 4999 AND $sum < 7500 ){
                $sum = self::percent_rate($sum, 25); //от 5k +25%
            }
            elseif($sum > 7499 AND $sum < 10000 ){
                $sum = self::percent_rate($sum, 30); //от 7.5k +30%
            }
            elseif($sum > 9999 AND $sum < 12500 ){
                $sum = self::percent_rate($sum, 35); //от 10k +35%
            }
            elseif($sum > 12499 AND $sum < 15000){
                $sum = self::percent_rate($sum, 40); //от 12.5k +40%
            }
            elseif($sum > 14999 AND $sum < 95000){
                $sum = self::percent_rate($sum, 50); //от 15к +50%
            }				
            else {
                $sum = $sum; // до 500 +0%
            }
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

    public function percent_rate($number, $percent) 
    {
        // Подсчёт бонуса 
        $number_percent = $number / 100 * $percent;
        return $number + $number_percent;
        
    }


}
