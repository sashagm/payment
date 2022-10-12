<?php

return [
    "isService"             => true,
    "Freekassa_serverURL"   => 'https://pay.freekassa.ru/',
    "Freekassa_merchantId"  => env('FREEKASSA_ID', NULL),
    "Freekassa_secretWord"  => env('FREEKASSA_SECRET', NULL),
    "Freekassa_lang"        => 'ru',
    "Freekassa_currency"    => 'RUB',
    "Freekassa_orderId"     => time(),
    "Freekassa_minSum"      => 25,
    'Freekassa_serverIP'  => array('127.0.0.1','168.119.157.136', '168.119.60.227', '138.201.88.124', '178.154.197.79'),
    ];