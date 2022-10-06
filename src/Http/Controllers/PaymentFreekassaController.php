<?php

namespace Sashagm\Payment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentFreekassaController extends Controller
{
    public function freekassaForm(Request $request)
    {
        //dd($request);

        $validator = Validator::make($request->all(), [
            'name' => 'required|exists:users|max:255',
            'sum' => 'required|numeric|min:1',
        ]);
        

        // Получить проверенные данные...
        $validated = $validator->validated();
        
        
    }

}
