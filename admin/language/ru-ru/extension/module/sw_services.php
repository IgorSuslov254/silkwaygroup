<?php

// Heading
$_['heading_title'] = 'Услуги';

// Common
$_['entry_status']   = 'Статус';
$_['text_enabled']   = 'Вкл.';
$_['text_disabled']  = 'Отк.';
$_['text_extension'] = 'Расширения';
$_['text_button_update'] = 'Изменить';
$_['text_button_delete'] = 'Удалить';
$_['text_button_create'] = 'Добавить';

$_['db'] = [
    'sw_services' => [
        'id' => 'ИД',
        'name' => 'Название',
        'description' => 'Описание',
        'photo' => 'Фото',
        'sort' => 'Сортировка',
        'comment' => $_['heading_title']
    ]
];

// Error
$_['install_error'] = "Ошибка при активации модуля '{$_['heading_title']}': ";
$_['uninstall_error'] = "Ошибка при удалении модуля '{$_['heading_title']}': ";
$_['enable_error'] = "Ошибка при включении модуля '{$_['heading_title']}': ";
$_['disabled_error'] = "Ошибка при выключении модуля '{$_['heading_title']}': ";
$_['update_error'] = "Ошибка при обновлении данных";
$_['create_error'] = "Ошибка при добавлении данных";
$_['delete_error'] = "Ошибка при удалении данных";
$_['alert_danger'] = '
    <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i>
        $error
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
';

// Success
$_['enable_success'] = "Модуль '{$_['heading_title']}' включён";
$_['disabled_success'] = "Модуль '{$_['heading_title']}' выключен";
$_['update_success'] = "Данные обновлены";
$_['create_success'] = "Данные добавлены";
$_['delete_success'] = "Данные удалены";
$_['alert_success'] = '
    <div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i>$success
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
';