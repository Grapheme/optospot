<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['withdraw_errors'] = array(
    "1" => "Успех",
    "2" => "Операция еще выполняется",
    "3" => "Операция отложена, будет выполнена позже",
    "4" => "Операция отложена для ручной проверки",
    "6" => "Ошибка проведения платежа",
    "12" => "Неверный формат запроса, отсутствуют нужные ноды",
    "14" => "Неверный ID проекта",
    "15" => "Проекту запрещены внешние выплаты",
    "16" => "На балансе проекта недостаточно средств",
    "17" => "Неверное значение ноды action",
    "18" => "Неверный ID системы-получателя",
    "19" => "Значение ноды params\account не прошло проверку на валидность",
    "20" => "Значение одной из дополнительных нод в params не прошло проверку на валидность",
    "21" => "Неверный ID валюты",
    "22" => "Неверный ID инвойса",
    "23" => "Ошибка на уровне системы-получателя",
    "24" => "Повторная попытка оплаты инвойса",
    "25" => "Транзакция с таким номером уже существует",
    "26" => "Неверная сумма платежа",
    "27" => "Сумма платежа слишком мала",
    "28" => "Сумма платежа слишком велика",
    "29" => "Неверный ID транзакции во внешней системе",
    "30" => "Отсутствует цифровая подпись запроса",
    "31" => "Неверная цифровая подпись запроса",
    "32" => "Пустой запрос",
    "34" => "Неверная подпись проекта-получателя перевода",
    "35" => "Переводы между основными балансами для проекта запрещены",
    "36" => "Запрос на проведение платежа в данной валюте запрещен",
    "97" => "Неверная дата истечения срока действия карты",
    "98" => "Неверное имя держателя карты",
    "99" => "Платеж отменен",
    "100" => "Не прошла проверка на стороне провайдера",
    "101" => "Номер телефона не из диапазона провайдера",
    "102" => "Некорректный номер банковской карты",
    "103" => "Превышен лимит средств на кошельках получателя",
    "104" => "Не найден кошелек WebMoney",
    "108" => "Некорректный e-mail",
    "109" => "Некорректный номер телефона",
    "200" => "Общая ошибка при выплате в провайдера",
    "202" => "Аккаунт-получатель платежа блокирован",
    "203" => "Превышен лимит платежей на указанный аккаунт",
    "204" => "Услуга не полностью сконфигурирована",
    "991" => "Переданы неполные или неверные персональные данные",
    "994" => "Истек срок действия секретного ключа",
    "995" => "Доступ с текущего IP запрещен",
    "996" => "Действие удалено",
    "997" => "Выплаты в указанного провайдера отвергнуты шлюзом-получателем",
    "998" => "Ключ проекта не найден. Используется для Conclusion",
    "999" => "Доступ запрещен",
    "1000" => "Внутренняя ошибка системы"
);

$config['withdraw_project'] = '6422';
$config['withdraw_secret'] = 'ypKMQTM7dgHDu4bL';
$config['withdraw_url'] = 'http://gsg.dengionline.com/api';
$config['withdraw_page'] = '/api';
$config['withdraw_phone'] = '9015115115';
$config['withdraw_currency'] = '643';
$config['withdraw_currency_title'] = 'Russian Ruble';
$config['withdraw_paysystems'] = array(2,9,19,22,23,33);
$config['withdraw_currencies'] = array('643' => 'Russian Ruble','978' => 'Euro','840' => 'US Dollar');

$Localization = new Localization();
$config['withdraw_clients'] = array(
    '2' => array(
        'title' => 'QIWI-кошелек',
        'visible' => TRUE,
        'account' => 'phone',
        'inputs' => array(
            'phone' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'account_number_qiwi'),
                'class' => 'valid-required phone-account'
            )
        )
    ),
    '9' => array(
        'title' => 'VISA/MasterCard',
        'visible' => TRUE,
        'account' => 'card-number',
        'inputs' => array(
            'card-number' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'card_number'),
                'class' => 'valid-required card-account'
            ),
            'name' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'holder_name'),
                'class' => 'valid-required card-name'
            ),
            'expiry' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'expiry_date'),
                'class' => 'valid-required card-expiry-date'
            )
        ),
    ),
    '33' => array(
        'title' => 'Яндекс.Деньги',
        'visible' => TRUE,
        'account' => 'yandex-number',
        'inputs' => array(
            'yandex-number' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'account_number'),
                'class' => 'valid-required'
            )
        )
    ),
    '19' => array(
        'title' => 'WebMoney',
        'visible' => TRUE,
        'account' => 'rebmoney-number',
        'inputs' => array(
            'rebmoney-number' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'account_number'),
                'class' => 'valid-required'
            )
        )
    ),
    '101' => array(
        'title' => 'BitCoin',
        'visible' => FALSE,
        'account' => 'bitcoin-number',
        'inputs' => array(
            'bitcoin-number' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'account_number'),
                'class' => 'valid-required'
            )
        )
    ),
    '103' => array(
        'title' => 'LiteCoin',
        'visible' => FALSE,
        'account' => 'litecoin-number',
        'inputs' => array(
            'litecoin-number' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'account_number'),
                'class' => 'valid-required'
            )
        )
    ),
    '104' => array(
        'title' => 'DogeCoin',
        'visible' => FALSE,
        'account' => 'dogecoin-number',
        'inputs' => array(
            'dogecoin-number' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'account_number'),
                'class' => 'valid-required'
            )
        )
    ),
    '105' => array(
        'title' => 'W1',
        'visible' => TRUE,
        'account' => 'w1-number',
        'inputs' => array(
            'w1-number' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'account_number'),
                'class' => 'valid-required'
            )
        )
    ),
    '106' => array(
        'title' => 'EgoPay',
        'visible' => TRUE,
        'account' => 'egopay-number',
        'inputs' => array(
            'egopay-number' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'account_number'),
                'class' => 'valid-required'
            )
        )
    ),
    '107' => array(
        'title' => 'Payza',
        'visible' => FALSE,
        'account' => 'payza-number',
        'inputs' => array(
            'payza-number' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'account_number'),
                'class' => 'valid-required'
            )
        )
    ),
    '108' => array(
        'title' => 'OOOPay',
        'visible' => TRUE,
        'account' => 'ooopay-number',
        'inputs' => array(
            'ooopay-number' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'account_number'),
                'class' => 'valid-required'
            )
        )
    ),
    '109' => array(
        'title' => 'RBK Money',
        'visible' => TRUE,
        'account' => 'rbk-number',
        'inputs' => array(
            'rbk-number' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'account_number'),
                'class' => 'valid-required'
            )
        )
    ),
    '110' => array(
        'title' => 'AstroPay',
        'visible' => TRUE,
        'account' => FALSE,
        'inputs' => array(
            'cpf' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'astropay_account_number'),
                'class' => 'valid-required'
            ),
            'bank' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'astropay_bank_number'),
                'class' => 'valid-required'
            ),
            'bank_branch' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'astropay_bank_branch'),
                'class' => 'valid-required'
            ),
            'bank_account' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'astropay_bank_account'),
                'class' => 'valid-required'
            ),
            'account_type' => array(
                'placeholder' => $Localization->getLocalButton('withdraw', 'astropay_account_type'),
                'class' => 'valid-required astropay-account-type'
            )
        )
    )
);


/*/
/* ASTROPAY
/*/

$config['astropay_base_url'] = 'https://astropaycard.com/api_curl/cashout_api/';

$config['astropay_x_login'] = 'OptoSpot';
$config['astropay_x_trans_key'] = '0p705p07';
$config['astropay_secret_key'] = 'pf2o3gn4m4v4e89vfa';