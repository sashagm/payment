<?php

namespace Sashagm\Payment\Actions\Webmoney;

use App\Models\User;
use Sashagm\Payment\Models\Payment;
use Sashagm\Payment\Actions\CheckBonus;
use Sashagm\Payment\Http\Requests\PaymentRequest;
use Spatie\FlareClient\Http\Response;

class CreatePayment
{

    public function create(PaymentRequest $request)
    {
       /**
         * Конвертация суммы из RUB->USD выставляем счёт в долларах 
         */
        $charger = $this->charger($request->sum);
        $order_AccountName = $request->name;
        $order_amount = $request->sum;
        $serverURL = config('payment.webmoney.serverURL');
        $merchant_id = config('payment.webmoney.merchantId');
        $order_id = config('payment.webmoney.orderId');
        $desc = 'Пополнение счёта для '. $request->name;
        /**$arGetParams = array(
            "LMI_PAYEE_PURSE" => $merchant_id,
            "LMI_PAYMENT_AMOUNT" => $charger,
            "LMI_PAYMENT_DESC"  => $desc,
            "LMI_PAYMENT_NO"   => $order_id,
            "LMI_SIM_MODE" => 0,
            "LMI_LANG"  => 'ru'
        ); */
        
        //if ($order_amount < 1000) { abort(403, "Необходима сумма от 1000");}

        // Создание заявки о платеже
        $user = User::where('name', $order_AccountName)->first();
        $payment = Payment::create([
            'user_id'   =>  $user->id,
            'desc'      =>  $order_id,
            'sum'       =>  $order_amount,
            'provider'  =>  3,
            'status'    =>  0
        ]);
        $payment->save();
        // Редирект к платёжке вебмоней, временное решение


echo '
<h1>Пополнить счёт через Webmoney</h1>
<h3>Рекомендованная сумма пополнения от 1000 рублей!!!</h3>
<form method="POST" action="https://merchant.webmoney.ru/lmi/payment_utf.asp" accept-charset="utf-8">
    <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="'.$charger.'">
    <input type="hidden" name="LMI_PAYMENT_DESC" value="'.$desc.'">
    <input type="hidden" name="LMI_PAYMENT_NO" value="'.$order_id.'">
    <input type="hidden" name="LMI_PAYEE_PURSE" value="'.$merchant_id.'">
    <input type="hidden" name="LMI_SIM_MODE" value="0">
    <input type="hidden" name="LMI_SUCCESS_METHOD" value="2">
    <input type="hidden" name="LMI_FAIL_METHOD" value="2">
    <input type="hidden" name="FIELD_1" value="VALUE_1">
    <input type="hidden" name="FIELD_2" value="VALUE_2">
    <input type="hidden" name="FIELD_N" value="VALUE_N">
    <button type="submit" class="btn btn-slide btn-slide-info mt-4"
                                        class="dl_btn">Оплатить '.$charger.' $</button>
  </form>';




        //return $urlTest = "https://merchant.webmoney.ru/lmi/payment.asp?at=authtype_8";

    }

    public function callback(CheckBonus $check,PaymentRequest $request)
    {
        if ($request->LMI_PREREQUEST == 1){
            if ($request->LMI_PAYEER_PURSE == config('payment.webmoney.merchantId')){ echo "YES"; }
            else {
               $key = $request->LMI_PAYEE_PURSE.
                $request->LMI_PAYMENT_AMOUNT.
                $request->LMI_PAYMENT_NO.
                $request->LMI_MODE.
                $request->LMI_SYS_INVS_NO.
                $request->LMI_SYS_TRANS_NO.
                $request->LMI_SYS_TRANS_DATE.
                config('payment.webmoney.secretWord').
                $request->LMI_PAYER_PURSE.
                $request->LMI_PAYER_WM;
                if (strtoupper(hash('sha256', $key)) != $request->LMI_HASH){ abort(403); }
                // Ищем заявку и пользователя 
                $payment = Payment::where('desc', $request->LMI_PAYMENT_NO)->first();
                $user = User::where('name', $payment->user_id)->first();
                $bal = $user->bonus;
                $sum = $payment->sum;
                // Добавляем бонус если имеется xD
                if ($user){
                $check->getBonus($sum);
                $user->bonus = $bal + $sum;
                $user->save();
                $payment->initid = $request->LMI_SYS_TRANS_NO;
                $payment->sum_bonus = $sum;
                $payment->status = 1; 
                $payment->save();
                }

            }
        }
    }

    public function charger($cost)
    {
        $languages = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp");
        //валюты
        foreach ($languages->Valute as $lang) {
        if ($lang["ID"] == 'R01235') { //тип валюты
        $koeficient1 = round(str_replace(',','.',$lang->Value), 2); //ее значение
        $koeficient1a = $lang->Nominal.' '.$lang->Name.' = '.$koeficient1.' руб.'; //запоминаем номинал
        } }
        return $charger = ceil($cost/$koeficient1 * 100) / 100;
    }

    public function backCharger($cost)
    {
        $languages = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp");
        //валюты
        foreach ($languages->Valute as $lang) {
        if ($lang["ID"] == 'R01235') { //тип валюты
        $koeficient1 = round(str_replace(',','.',$lang->Value), 2); //ее значение
        $koeficient1a = $lang->Nominal.' '.$lang->Name.' = '.$koeficient1.' руб.'; //запоминаем номинал
        } }
        return $check = $cost * $koeficient1;
    }

}