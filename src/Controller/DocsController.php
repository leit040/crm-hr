<?php

declare(strict_types=1);

namespace App\Controller;

use OpenApi\Generator;
use yii\web\Response;

final class DocsController extends BaseController
{
    /**
     * @OA\Info(title="Simple microservice API docs", version="0.1")
     */
    public function actionJson(): string
    {
        $openapi = Generator::scan([\Yii::getAlias('@app')]);
        \Yii::$app->getResponse()->format = Response::FORMAT_RAW;
        \Yii::$app->getResponse()->getHeaders()->set('Content-Type', 'application/json');

        return $openapi->toJson();
    }

    protected function verbs(): array
    {
        return [];
    }
}
