<?php
return [
    'custom' => [
        'email' => [
            'required' => 'Укажите email',
            'email' => 'Укажите корректный email',
            'unique' => 'Данный email зарегистрирован'
        ],
        'password' => [
            'required' => 'Укажите пароль',
            'min' => 'Пароль должен содержать минимум 6 символов',
            'confirmed' => "Пароли не совпадают"
        ],
        'name' => [
            'required' => 'Укажите имя',
        ]
    ],
    'notFirm'=>'Такого объекта нету'
];

