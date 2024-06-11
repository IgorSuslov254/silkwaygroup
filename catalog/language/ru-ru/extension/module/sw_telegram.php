<?php

// Heading
$_['heading_title'] = 'Модальное окно отправки в телеграмм';

// Common
$_['button'] = 'Отправить';
$_['button_close'] = 'закрыть';
$_['button_loading_text'] = 'Отправка...';
$_['form_name'] = 'Заказ звонка';

$_['form'] = [
    [
        'type' => 'text',
        'name' => 'name',
        'placeholder' => 'Имя',
        'minlength' => 1,
        'maxlength' => 50
    ],
    [
        'type' => 'tel',
        'name' => 'phone',
        'placeholder' => 'Телефон',
        'minlength' => 1,
        'maxlength' => 50
    ]
];

// Error
$_['get_error'] = "Ошибка загрузи данных модуля: \"{$_['heading_title']}\" ";
$_['button_error'] = 'Произошла ошибка';
$_['no_data_found'] = 'Нет данных для отправки в телеграмм';

// Success
$_['button_success'] = 'Мы вам скоро позвоним';
