<?php

declare(strict_types=1);
$repository = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(Dotenv\Repository\Adapter\EnvConstAdapter::class)
    ->addWriter(Dotenv\Repository\Adapter\PutenvAdapter::class)
    ->immutable()
    ->make();

$dotenv = Dotenv\Dotenv::create($repository, dirname(__DIR__));
$dotenv->load();
$dotenv->required('YII_DEBUG')->isBoolean();
$dotenv->required('YII_ENV')->allowedValues([
    'prod',
    'dev',
]);
$dotenv->required('DB_DSN')->notEmpty();
$dotenv->required('DB_USERNAME')->notEmpty();
$dotenv->required('DB_PASSWORD')->notEmpty();
$dotenv->required('DB_TABLE_PREFIX');
$dotenv->required('DB_CHARSET')->notEmpty();

\defined('YII_DEBUG') || \define('YII_DEBUG', env('YII_DEBUG'));
\defined('YII_ENV') || \define('YII_ENV', env('YII_ENV', 'prod'));
