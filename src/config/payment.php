<?php

return [
    "isService"             => true,
    "minSum"      => 25,

    "Freekassa_active"       => false,
    "Freekassa_serverURL"   =>  'https://pay.freekassa.ru/',
    "Freekassa_merchantId"  =>  env('FREEKASSA_ID', NULL),
    "Freekassa_secretWord"  =>  env('FREEKASSA_SECRET', NULL),
    "Freekassa_lang"        =>  'ru',
    "Freekassa_currency"    =>  'RUB',
    "Freekassa_orderId"     =>  time(),
    'Freekassa_serverIP'    =>  array('127.0.0.1','168.119.157.136', '168.119.60.227', '138.201.88.124', '178.154.197.79'),

    "PAYEER_active"       => true,
    "PAYEER_serverURL"      =>  "https://payeer.com/merchant/",
    "PAYEER_orderId"        =>  time(),
    "PAYEER_shopId"         =>  env('PAYEER_ID', NULL),
    "PAYEER_secretWord"     =>  env('PAYEER_SECRET', NULL),
    "PAYEER_currency"       =>  'RUB',
    "PAYEER_serverIP"       =>  array('185.71.65.92', '185.71.65.189', '149.202.17.210'),
];