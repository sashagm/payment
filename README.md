## Прием платежей для игровых проектов Loong Online/Blood and Soul на платформе Laravel

#### Установка

- composer require sashagm/payment
- php artisan vendor:publish --provider="Sashagm\Payment\Providers\PaymentServiceProvider"
- php artisan migrate

#### Настройки для Freekassa

- На сайте [freekassa](https://merchant.freekassa.ru/) необходимо создать наш мерчант. 
Подключаем домен и проходим модерацию. 
- URL заполняем:
| Название | URL | Метод   |
| ------ | ------ | ------ |
| Обработчик | [http://domain.com/payment/freekassa] | POST |
| Страница после оплаты | [http://domain.com/payment/?pay=ok] | GET |
| Страница ошибки оплаты | [http://domain.com/?pay=error] |  GET |
- Настроить файл конфиг ** config/payment.php **
- Добавить конcтанты в файл ** .env ** 
    * FREEKASSA_ID
    * FREEKASSA_SECRET
