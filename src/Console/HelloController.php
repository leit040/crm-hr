<?php

declare(strict_types=1);

namespace App\Console;

use yii\console\Controller;
use yii\console\ExitCode;

final class HelloController extends Controller
{
    public function actionIndex()
    {
        $this->stdout("Hello world!\n");

        return ExitCode::OK;
    }
}
