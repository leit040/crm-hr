<?php

declare(strict_types=1);

namespace App\Model;

use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use yii\db\ActiveRecord;

abstract class BaseModel extends ActiveRecord implements ContainsRecordedMessages
{
    private array $events = [];

    final public function recordThat(object $event): void
    {
        $this->events[] = $event;
    }

    public function recordedMessages(): array
    {
        return $this->events;
    }

    public function eraseMessages(): void
    {
        $this->events = [];
    }
}
