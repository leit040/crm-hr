<?php

declare(strict_types=1);

namespace App\Model;

use App\Event\UserWasCreated;
use yii\base\InvalidArgumentException;

final class User extends BaseModel
{
    public string $uuid;
    public string $email;

    public static function create(string $uuid, string $email): self
    {
        if (!filter_var($email, \FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('Email %s is not valid email address.', $email));
        }
        $user = new self();
        $user->uuid = $uuid;
        $user->email = $email;
        $user->recordThat(UserWasCreated::with($email));

        return $user;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function email(): string
    {
        return $this->email;
    }
}
