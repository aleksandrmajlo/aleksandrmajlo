<?php
return [
    'custom' => [
        'email' => [
            'required' => 'Вкажіть email',
            'email' => 'Вкажіть коректний email',
            'unique' => 'Даний email зареєстрований'
        ],
        'password' => [
            'required' => 'Вкажіть пароль',
            'min' => 'Пароль повинен містити не менше 6 символів',
            'confirmed' => "Паролі не співпадають"
        ],
        'name' => [
            'required' => 'Вкажіть ім\'я',
        ]
    ],
    'notFirm'=>'Такого об\'єкта немає'
];

