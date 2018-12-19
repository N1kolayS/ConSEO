<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    'screenshots1200.url' => 'http://mini.s-shot.ru/1200x768/jpeg/1200/Z100/?',

    'map.start' => [
        [
            'name' => 'Прямой заход',
            'code' => '111',
            'default' => true,
        ],
        [
            'name' => 'Google Поиск',
            'code' => '100',
            'referral' =>  'www.google.ru',
        ],
        [
            'name' => 'Яндекс Поиск',
            'code' => '200',
            'referral' => 'yandex.ru',
        ],

        [
            'name' => 'Вконтакте',
            'code' => '400',
            'referral' => 'away.vk.com'
        ],
        [
            'name' => 'Кампания my_campaign',
            'code' => '500',
            'utm_campaign' =>  'my_campaign'
        ],
    ],
];
