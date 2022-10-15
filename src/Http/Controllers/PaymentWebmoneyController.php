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




        }
}

