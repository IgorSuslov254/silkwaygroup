<?php

$_['text_banner'] = 'Если вам нужна примерная стоимость доставки,<br>Вы можете самостоятельно рассчитать её на калькуляторе.';
$_['text_button_banner'] = 'Рассчитать доставку';
$_['form'] = [
    'inputs' => [
        [
            'name' => 'width',
            'type' => 'number',
            'placeholder' => 'Ширина коробки',
            'min' => '1',
            'max' => '5000'
        ],
        [
            'name' => 'length',
            'type' => 'number',
            'placeholder' => 'Длина коробки',
            'min' => '1',
            'max' => '5000'
        ],
        [
            'name' => 'depth',
            'type' => 'number',
            'placeholder' => 'Глубина коробки',
            'min' => '1',
            'max' => '5000'
        ],
        [
            'name' => 'weight',
            'type' => 'number',
            'placeholder' => 'Вес коробки',
            'min' => '1',
            'max' => '5000'
        ]
    ],
    'selects' => [
        'cloth_type' => [
            'name' => 'cloth_type',
            'default_value' => 'Тип груза',
        ],
        'route' => [
            'name' => 'route',
            'default_value' => 'Маршрут',
        ]
    ],
    'checkboxes' => [
        [
            'name' => 'is-box',
            'type' => 'checkbox',
            'placeholder' => 'Добавить обрешетку (добавит около 10% к весу груза, и увеличит безопасноть доставки)'
        ]
    ],
    'p' => [
        'text_load' => 'Производится рассчёт...',
        'text_answer' => 'Приблизительная стоимость доставки: ',
        'text_error' => 'По данным параметрам расчёт не возможен'
    ],
    'buttons' => [
        'submit' => [
            'text' => 'Рассчитать'
        ],
        'close' => [
            'text' => 'Закрыть'
        ]
    ]
];