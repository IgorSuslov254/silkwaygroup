<?php

// Heading
$_['heading_title'] = 'Information about deliveries';

// Common
$_['entry_status']   = 'Status';
$_['text_enabled']   = 'On.';
$_['text_disabled']  = 'Off.';
$_['text_extension'] = 'Extensions';
$_['text_button_update'] = 'Change';
$_['text_button_delete'] = 'Remove';
$_['text_button_create'] = 'Add';

$_['db'] = [
    'sw_calc' => [
        'id' => 'ID',
        'text_banner' => 'Text banner',
        'text_button' => 'text button',
        'photo' => 'Photo',
        'sort' => 'Sort',
        'comment' => 'Interface table'
    ],
    'sw_calc_price' => [
        'id' => 'ID',
        'id_sw_calc_route' => 'Route ID',
        'id_sw_calc_cloth_type' => 'Clothing type ID',
        'price' => 'Price',
        'density' => 'Density',
        'sort' => 'Sort',
        'comment' => 'Summary table'
    ],
    'sw_calc_cloth_type' => [
        'id' => 'ID',
        'name' => 'Name',
        'sort' => 'Sort',
        'comment' => 'Type of clothing'
    ],
    'sw_calc_route' => [
        'id' => 'ID',
        'name' => 'Name',
        'sort' => 'Sort',
        'comment' => 'Route'
    ],
];

// Error
$_['install_error'] = "Error when activating the module '{$_['heading_title']}': ";
$_['uninstall_error'] = "Error deleting the module '{$_['heading_title']}': ";
$_['enable_error'] = "Error when enabling the module '{$_['heading_title']}': ";
$_['disabled_error'] = "Error when turning off the module '{$_['heading_title']}': ";
$_['update_error'] = "Error updating data: ";
$_['create_error'] = "Error when adding data: ";
$_['create_duplicate_entry_error'] = "Such a record already exists";
$_['delete_error'] = "Error deleting data: ";
$_['error_create_table'] = 'Error creating a table in the database';
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