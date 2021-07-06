<?php

declare(strict_types=1);

namespace App\Response;

final class EmptyResponse
{
    public function __construct(int $statusCode = 200)
    {
        \Yii::$app->getResponse()->setStatusCode($statusCode);
        \Yii::$app->getResponse()->content = '';
        \Yii::$app->getResponse()->send();
    }
}
