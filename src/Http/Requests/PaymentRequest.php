<?php

namespace Sashagm\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|exists:users|max:255',
            'sum' => 'required|numeric|min:'. config('payment.general.minSum'),
        ];
    }

    public function attribute()
    {

    }

    public function messages()
    {
       return [
            'name.required'     => 'Вы не указали логин.',
            'name.exists'       => 'Указанный логин не найден.',
            'name.string'       => 'Поле логин должен быть строкой.',
            'sum.required'      => 'Вы не указали сумму.',
            'sum.numeric'       => 'Поле сумма должно быть числом.',
            'sum.min'           => 'Минимальная сумма пополнения: ' . config('payment.general.minSum'). " RUB.",
        ];        
    }

}
