<?php

return [

    "general"  => [
        "isService"     => true,
        "minSum"        => 25,
        "userTable"     => "user"
    ], 
    "freekassa" => [
        "active"        => true,
        "serverURL"     => "https://pay.freekassa.ru/",
        "merchantId"    => env('FREEKASSA_ID', NULL),
        "secretWord"    => env('FREEKASSA_SECRET', NULL),
        "lang"          => "ru",
        "currency"      => "RUB",
        "orderId"       => time(),
        "serverIP"      => array('168.119.157.136', '168.119.60.227', '138.201.88.124', '178.154.197.79'),
    ],
    "payeer" => [
        "active"        => true,
        "serverURL"     => "https://payeer.com/merchant/",
        "orderId"       => time(),
        "shopId"        => env('PAYEER_ID', NULL),
        "secretWord"    => env('PAYEER_SECRET', NULL),
        "currency"      => "RUB",
        "serverIP"      => array('185.71.65.92', '185.71.65.189', '149.202.17.210'),
    ],
    "webmoney" => [
        "active"        => true,
        "serverURL"     => "https://merchant.webmoney.ru/lmi/payment_utf.asp",
        "orderId"       => time(),
        "merchantId"    => env('WEBMONEY_ID', NULL),
        "secretWord"    => env('WEBMONEY_SECRET', NULL),
        "secretWord20"  => env('WEBMONEY_SECRET20', NULL),
        "recomend"      => 1000
    ],

];