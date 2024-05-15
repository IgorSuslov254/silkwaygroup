<?php

// Heading
$_['heading_title'] = 'Информация о доставках';

$_['entry_status']   = 'Статус';
$_['text_enabled']   = 'Вкл.';
$_['text_disabled']  = 'Отк.';
$_['text_extension'] = 'Расширения';

//error
$_['install_error'] = "Ошибка при активации модуля '{$_['heading_title']}': ";
$_['uninstall_error'] = "Ошибка при удалении модуля '{$_['heading_title']}': ";
$_['enable_error'] = "Ошибка при включении модуля '{$_['heading_title']}': ";
$_['disabled_error'] = "Ошибка при выключении модуля '{$_['heading_title']}': ";
$_['alert_danger'] = '
    <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i>
        $error
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
';

//success
$_['enable_success'] = "Модуль '{$_['heading_title']}' включён";
$_['disabled_success'] = "Модуль '{$_['heading_title']}' выключен";
$_['alert_success'] = '
    <div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i>$success
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
';