<?php

declare(strict_types=1);

return [
    'bootstrap' => [
        'log',
        \App\DependencyInjection\Bootstrap::class,
    ],
    'aliases' => [
        '@app' => \dirname(__DIR__) . '/src',
    ],
    'components' => [
        'formatter' => [
            'class' => \yii\i18n\Formatter::class,
            'dateFormat' => 'php:Y-m-d',
            'datetimeFormat' => 'php:' . \DATE_ATOM,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => env('DB_DSN'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'tablePrefix' => env('DB_TABLE_PREFIX'),
            'charset' => env('DB_CHARSET', 'utf8'),
            'enableSchemaCache' => YII_ENV_PROD,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@app/../runtime/logs/app.log',
                ],
            ],
        ],
    ],
];
