<?php

declare(strict_types=1);

namespace App\Event;

final class UserWasCreated
{
    private string $email;

    private function __construct(string $email)
    {
        $this->email = $email;
    }

    public static function with(string $email): self
    {
        return new self($email);
    }

    public function email(): string
    {
        return $this->email;
    }
}
