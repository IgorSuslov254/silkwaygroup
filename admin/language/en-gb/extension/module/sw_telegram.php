<?php

// Heading
$_['heading_title'] = 'Sending to Telegram';

// Common
$_['entry_status']   = 'Status';
$_['text_enabled']   = 'On.';
$_['text_disabled']  = 'Off.';
$_['text_extension'] = 'Extensions';
$_['text_button_update'] = 'Change';
$_['text_button_delete'] = 'Remove';
$_['text_button_create'] = 'Add';

$_['db'] = [
    'sw_telegram' => [
        'id' => 'ID',
        'selector' => 'selector',
        'name' => 'name',
        'description' => 'description',
        'sort' => 'sort',
        'comment' => 'The table of sending to telegram'
    ],
    'sw_telegram_settings' => [
        'id' => 'ID',
        'token' => 'token',
        'chat_id' => 'chat id',
        'sort' => 'sort',
        'comment' => 'The table of settings in telegram'
    ],
];

// Error
$_['install_error'] = "Error when activating the module '{$_['heading_title']}': ";
$_['uninstall_error'] = "Error deleting the module '{$_['heading_title']}': ";
$_['enable_error'] = "Error when enabling the module '{$_['heading_title']}': ";
$_['disabled_error'] = "Error when turning off the module '{$_['heading_title']}': ";
$_['update_error'] = "Error updating data";
$_['create_error'] = "Error when adding data";
$_['delete_error'] = "Error deleting data";
$_['alert_danger'] = '
    <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i>
        $error
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
';

// Success
$_['enable_success'] = "Module '{$_['heading_title']}' On";
$_['disabled_success'] = "Module '{$_['heading_title']}' Off";
$_['update_success'] = "Data updated";
$_['create_success'] = "Data added";
$_['delete_success'] = "Data deleted";
$_['alert_success'] = '
    <div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i>$success
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
';