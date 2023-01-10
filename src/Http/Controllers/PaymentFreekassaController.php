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

    public function freekassa(CreatePayment $pay, CheckBonus $check, Request $request)
    {
        $pay->callback($check, $request);
    }

public function callback(Request $request, CheckBonus $check, CreatePayment $pay){
    
        // Получаем реквест с фрикассы
        $merchant_id = config('payment.freekassa.merchantId');
        $secret_word = config('payment.freekassa.secretWord');
        $sum = $request->AMOUNT;
        $accName = $request->us_AccountName;
        $desc = $request->MERCHANT_ORDER_ID;
        $initid = $request->initid;
        $sigShop = md5($merchant_id.":".$sum.":".$secret_word.":".$desc);
        // Проверки
        if (!in_array(self::getIP(), config('payment.freekassa.serverIP'))) { abort(403); }
        //if ($sigShop != $request->SIGN) { abort(403);  }
        // Ищем пользователя 
        $user = User::where('name', $accName)->first();
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
    
    
 
    public function percent_rate($number, $percent) 
    {
        // Подсчёт бонуса 
        $number_percent = $number / 100 * $percent;
        return $number + $number_percent;
        
    }

}
