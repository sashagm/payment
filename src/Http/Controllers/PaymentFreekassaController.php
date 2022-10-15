<?php

namespace Sashagm\Payment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Sashagm\Payment\Models\Payment;
use App\Models\User;

class PaymentFreekassaController extends Controller
{
    public function freekassaForm(Request $request)
    {
        // Валидация
        $messages = [
            'name.required'     => 'Вы не указали логин.',
            'name.exists'       => 'Указанный логин не найден.',
            'name.string'       => 'Поле логин должен быть строкой.',
            'sum.required'      => 'Вы не указали сумму.',
            'sum.numeric'       => 'Поле сумма должно быть число.',
            'sum.min'           => 'Поле сумма должно быть больше ' . config('payment.Freekassa_minSum'),
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|exists:users|max:255',
            'sum' => 'required|numeric|min:'. config('payment.Freekassa_minSum'),
        ], $messages);
        // Получить проверенные данные...
        $validated = $validator->validated();
        // Конфиги и подписание хэша
        $serverURL = config('payment.Freekassa_serverURL');
        $merchant_id = config('payment.Freekassa_merchantId');
        $secret_word = config('payment.Freekassa_secretWord');
        $lang = config('payment.Freekassa_lang');
        $order_amount = $request->sum;
		$order_id = config('payment.Freekassa_orderId');
		$order_AccountName = $request->name;
		$currency = config('payment.Freekassa_currency');
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
        $urlTest = $serverURL."?m=".$merchant_id."&oa=".$order_amount."&o=".$order_id."&currency=".$currency."&s=".$sigShop."&lang=".$lang."&us_AccountName=".$order_AccountName;
        return redirect($urlTest);
    }

    public function freekassa(Request $request)
    {
        // Получаем реквест с фрикассы
        $merchant_id = config('payment.Freekassa_merchantId');
        $secret_word = config('payment.Freekassa_secretWord');
        $email = $request->P_EMAIL;
	    $sum = $request->AMOUNT;
	    $accName = $request->us_AccountName;
        $desc = $request->MERCHANT_ORDER_ID;
        $initid = $request->initid;
        $sigShop = md5($merchant_id.":".$sum.":".$secret_word.":".$desc);
        // Проверки
        if (!in_array(self::getIP(), config('payment.Freekassa_serverIP'))) {
            abort(403);
        }
        if ($sigShop != $request->SIGN) {
            abort(403);
        }
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
