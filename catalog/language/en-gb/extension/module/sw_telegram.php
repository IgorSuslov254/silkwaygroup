<?php

// Heading
$_['heading_title'] = 'Modal window for sending in telegrams';

// Common
$_['button'] = 'Send';
$_['button_close'] = 'To close';
$_['button_loading_text'] = 'Shipment...';
$_['form_name'] = 'Ordering a call';

$_['form'] = [
    [
        'type' => 'text',
        'name' => 'name',
        'placeholder' => 'Name',
        'minlength' => 1,
        'maxlength' => 50
    ],
    [
        'type' => 'tel',
        'name' => 'phone',
        'placeholder' => 'Phone',
        'minlength' => 1,
        'maxlength' => 50
    ]
];

// Error
$_['get_error'] = "Error loading module data: \"{$_['heading_title']}\" ";
$_['button_error'] = 'An error has occurred';
$_['no_data_found'] = 'There is no data to send in telegram';

// Success
$_['button_success'] = 'We will call you soon';
