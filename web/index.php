<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/helpers.php';
require __DIR__ . '/../config/env.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = \yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../config/common.php',
    require __DIR__ . '/../config/config.php',
);

(new yii\web\Application($config))->run();
