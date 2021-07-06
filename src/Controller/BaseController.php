<?php

declare(strict_types=1);

namespace App\Controller;

use Yii;
use yii\base\Model;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

abstract class BaseController extends Controller
{
    /**
     * @var string|array the configuration for creating the serializer that formats the response data
     */
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    /**
     * {@inheritdoc}
     */
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::class,
                'actions' => $this->verbs(),
            ],
            'cors' => [
                'class' => Cors::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function afterAction($action, $result): mixed
    {
        $result = parent::afterAction($action, $result);

        return $this->serializeData($result);
    }

    /**
     * Serializes the specified data.
     * The default implementation will create a serializer based on the configuration given by [[serializer]].
     * It then uses the serializer to serialize the given data.
     */
    protected function serializeData($data): mixed
    {
        return Yii::createObject($this->serializer)->serialize($data);
    }

    abstract protected function verbs(): array;

    public function load(Model $model)
    {
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
    }
}
