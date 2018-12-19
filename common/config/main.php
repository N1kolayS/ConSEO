<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',

        '@screen_shot' => '@frontend/web/screenshot/', // Path for saved screenshots
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'language' => 'ru-RU',
        'sourceLanguage' => 'ru-Ru',
        'name' => 'Con-SEO',
      //  'timeZone' => 'Europe/Moscow',
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
         //   'defaultTimeZone' => 'Europe/Moscow',
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'RUR',
            'locale' => 'ru-RU'
        ],
    ],
];
