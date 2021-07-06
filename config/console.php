<?php

declare(strict_types=1);

return [
    'id' => 'micro-app-console',
    // the basePath of the application will be the `micro-app` directory
    'basePath' => __DIR__,
    'controllerNamespace' => 'App\Console',
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationPath' => [
                \dirname(__DIR__) . '/migrations',
            ],
        ],
    ],
];
