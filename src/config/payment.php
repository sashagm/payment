<?php

return [
    "isService"             => true,
    "Freekassa_serverURL"   => 'https://pay.freekassa.ru/',
    "Freekassa_merchantId"  => env('FREEKASSA_ID', NULL),
    "Freekassa_secretWord"  => env('FREEKASSA_SECRET', NULL),
    "Freekassa_lang"        => 'ru',
    "Freekassa_currency"    => 'RUB',
    "Freekassa_orderId"     => 'shop_'.time(),
    "Freekassa_minSum"      => 25,
    ];
