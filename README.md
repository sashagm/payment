## Прием платежей для игровых проектов Loong Online/Blood and Soul на платформе Laravel

#### Описание
С помощью нашего пакета можно принимать оплату на вашем сайте. В автоматическом режиме обработать и выполнить зачисление на аккаунт. Имеется опционально система бонусов на пополнение счёта. Например при
пополнение счёта на сумму 1000 на счёт аккаунта будет зачислено 1100 (+10%). Можно полностью настроить систему бонусов на ваш вкус.

#### Установка

- composer require sashagm/payment
- php artisan payment:install


#### Поддержка платежных систем

- [freekassa](https://merchant.freekassa.ru/)
- [payeer](https://payeer.com/)
- [webmoney](https://merchant.web.money/)
- [litekassa](https://www.lite-kassa.ru/)
- [payok](https://payok.io/)

#### Настройки

##### Валюты

- Основная
    - 643 Российский рубль (RUB) 
- Webmoney 
    - 840 Доллар США (USD)

##### Маршруты

| Название      | URL                                    | Метод         |
| ------------- | -------------------------------------- | ------------- |
| Обработчик    | [http://domain.com/payment/freekassa]  | POST          |
| Обработчик    | [http://domain.com/payment/payeer]     | POST          |
| Обработчик    | [http://domain.com/payment/webmoney]   | POST          |
| Обработчик    | [http://domain.com/payment/litekassa]  | POST          |
| Обработчик    | [http://domain.com/payment/payok]      | POST          |
| Успех         | [http://domain.com/payment/success]    | GET           |
| Ошибка        | [http://domain.com/payment/error]      | GET           |



##### Конфигурация

- Настроить файл конфиг `config/payment.php`
- Добавить необходимые настройки в файл `.env`
    * FREEKASSA_ID
    * FREEKASSA_SECRET
    * PAYEER_ID
    * PAYEER_SECRET
    * WEBMONEY_ID
    * WEBMONEY_SECRET
    * LITEKASSA_ID
    * LITEKASSA_SECRET  
    * PAYOK_ID
    * PAYOK_SECRET       


#### Примечания
- Если не работает обработчик?
  - Так как работает на **Laravel** используется CSRF защита, необходимо исключить маршруты, добавив их URI в свойство `$except` посредника **VerifyCsrfToken**: 
```
  protected $except = [
    'payment/*',
  ];

```
- Webmoney не принимает российские рубли (RUB)?
    - На данный момент Прекращена работа с RU кошельками! Конвертация суммы из RUB->USD в реальном времени и выставляем счёт в USD. 

#### Лицензия

Payment - это программное обеспечение с открытым исходным кодом, лицензированное по [MIT license](LICENSE.md ).