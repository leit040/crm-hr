<?php

declare(strict_types=1);

$config = [
    'id' => 'micro-app',
    // the basePath of the application will be the `micro-app` directory
    'basePath' => \dirname(__DIR__),
    // this is where the application will find all controllers
    'controllerNamespace' => 'App\Controller',
    // set an alias to enable autoloading of classes from the 'micro' namespace
    'aliases' => [
        '@micro' => \dirname(__DIR__),
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '123',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'assetManager' => [
            'class' => \yii\web\AssetManager::class,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
