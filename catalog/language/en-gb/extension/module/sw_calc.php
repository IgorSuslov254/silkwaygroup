<?php

$_['text_banner'] = 'If you need an approximate shipping cost,<br>You can calculate it yourself on the calculator.';
$_['text_button_banner'] = 'Calculate the delivery';
$_['form'] = [
    'inputs' => [
        [
            'name' => 'width',
            'type' => 'number',
            'placeholder' => 'width',
            'min' => '1',
            'max' => '5000'
        ],
        [
            'name' => 'length',
            'type' => 'number',
            'placeholder' => 'length',
            'min' => '1',
            'max' => '5000'
        ],
        [
            'name' => 'depth',
            'type' => 'number',
            'placeholder' => 'depth',
            'min' => '1',
            'max' => '5000'
        ],
        [
            'name' => 'weight',
            'type' => 'number',
            'placeholder' => 'weight',
            'min' => '1',
            'max' => '5000'
        ]
    ],
    'selects' => [
        'cloth_type' => [
            'name' => 'cloth_type',
            'default_value' => 'cloth type',
        ],
        'route' => [
            'name' => 'route',
            'default_value' => 'route',
        ]
    ],
    'checkboxes' => [
        [
            'name' => 'is-box',
            'type' => 'checkbox',
            'placeholder' => 'Add a crate (it will add about 10% to the weight of the cargo, and increase the safety of delivery)'
        ]
    ],
    'p' => [
        'text_load' => 'The calculation is being made...',
        'text_answer' => 'Approximate shipping cost: ',
        'text_error' => 'Calculation is not possible according to these parameters'
    ],
    'buttons' => [
        'submit' => [
            'text' => 'Calculate'
        ],
        'close' => [
            'text' => 'To close'
        ]
    ]
];