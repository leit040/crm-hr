<?php

declare(strict_types=1);

namespace App\Controller;

use App\Response\EmptyResponse;

class HealthzController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/healthz",
     *     tags={"Health check"},
     *     summary="Get health status",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     )
     * )
     */
    public function actionIndex(): EmptyResponse
    {
        return new EmptyResponse();
    }

    protected function verbs(): array
    {
        return [
            'index' => ['GET'],
        ];
    }
}
