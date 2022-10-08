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
            'sum'       =>  $order_amount,
            'sum_bonus' =>  null,
            'provider'  =>  1,
            'status'    =>  0
        ]);
        $payment->save();
		//	Редирект к платёжке фрикасса
        $urlTest = $serverURL."?m=".$merchant_id."&oa=".$order_amount."&o=".$order_id."&currency=".$currency."&s=".$sigShop."&lang=".$lang."&us_AccountName=".$order_AccountName;
        return redirect($urlTest);
    }

}
