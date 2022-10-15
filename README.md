## Прием платежей для игровых проектов Loong Online/Blood and Soul на платформе Laravel

#### Описание
С помощью нашего пакета можно принимать оплату на вашем сайте. В автоматическом режиме обработать и выполнить зачисление на аккаунт. Имеется опционально система бонусов на пополнение счёта. Например при
пополнение счёта на сумму 1000 на счёт аккаунта будет зачислено 1100 (+10%). Можно полностью настроить систему бонусов на ваш вкус.

#### Установка

- composer require sashagm/payment
- php artisan vendor:publish --provider="Sashagm\Payment\Providers\PaymentServiceProvider"
- php artisan migrate

#### Поддержка платежных систем

- [freekassa](https://merchant.freekassa.ru/)
- [payeer](https://payeer.com/)

#### Настройки для Freekassa

- На сайте [freekassa](https://merchant.freekassa.ru/) необходимо создать наш мерчант. 
Подключаем домен и проходим модерацию. 
- URL заполняем:

| Название      | URL                                    | Метод         |
| ------------- | -------------------------------------- | ------------- |
| Обработчик    | [http://domain.com/payment/freekassa]  | POST          |
| Успех         | [http://domain.com/payment/?pay=ok]    | GET           |
| Ошибка        | [http://domain.com/?pay=error]         | GET           |

- Настроить файл конфиг **config/payment.php**
- Добавить конcтанты в файл **.env** 
    * FREEKASSA_ID
    * FREEKASSA_SECRET

#### Настройки для Payeer

- На сайте [payeer](https://payeer.com/) необходимо создать наш мерчант. 
Подключаем домен и проходим модерацию. 
- URL заполняем:

| Название      | URL                                    | Метод         |
| ------------- | -------------------------------------- | ------------- |
| Обработчик    | [http://domain.com/payment/payeer]     | POST          |
| Успех         | [http://domain.com/payment/?pay=ok]    | GET           |
| Ошибка        | [http://domain.com/?pay=error]         | GET           |

- Настроить файл конфиг **config/payment.php**
- Добавить конcтанты в файл **.env** 
    * PAYEER_ID
    * PAYEER_SECRET
