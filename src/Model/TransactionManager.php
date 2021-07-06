<?php

declare(strict_types=1);

namespace App\Model;

final class TransactionManager
{
    public function wrap(callable $callable): void
    {
        $transaction = \Yii::$app->getDb()->beginTransaction();
        try {
            $callable();
            $transaction->commit();
        } catch (\Exception $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }
}
