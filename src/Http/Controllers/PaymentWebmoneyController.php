<?php

namespace Sashagm\Payment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Sashagm\Payment\Models\Payment;
use App\Models\User;

class PaymentWebmoneyController extends Controller
{
    public function webmoneyForm(Request $request)
    {
        // Валидация
        if (config('payment.Webmoney_active') != "true") {
            abort(403, 'Данный способ временно отключён!');
        }
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
        /**
         * Конвертация суммы из RUB->USD выставляем счёт в долларах 
         */
        $charger = self::charger($request->sum);
        // Получить проверенные данные...
        $validated = $validator->validated();
        $order_AccountName = $request->name;
        $order_amount = $request->sum;
        $serverURL = config('payment.Webmoney_serverURL');
        $merchant_id = config('payment.Webmoney_merchantId');
        $order_id = config('payment.Webmoney_orderId');
        $desc = base64_encode('Пополнение счёта для '. $request->name);
        $arGetParams = array(
            "LMI_PAYEE_PURSE" => $merchant_id,
            "LMI_PAYMENT_AMOUNT" => $charger,
            "LMI_PAYMENT_DESC"  => $desc,
            "LMI_PAYMENT_NO"   => $order_id,
            "LMI_SIM_MODE" => 0,
            "LMI_LANG"  => 'ru'
        );
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
        return redirect('http://0pi.ru/post.php?url=https://merchant.webmoney.ru/lmi/payment.asp?at=authtype_8[POST]'.http_build_query($arGetParams));
        }

        public function webmoney(Request $request)
        {
            //TODO: Доработать
            dd($request);

        }

        public function percent_rate($number, $percent) 
        {
            // Подсчёт бонуса 
            $number_percent = $number / 100 * $percent;
            return $number + $number_percent;
            
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

