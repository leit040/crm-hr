<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\User;
use PHPUnit\Framework\TestCase;
use yii\base\InvalidArgumentException;

final class UserTest extends TestCase
{
    public function testUserWithInvalidEmail()
    {
        $this->expectException(InvalidArgumentException::class);
        User::create('safsafa', 'safsa');
    }

    public function testRecorededMessage()
    {
        $user = User::create('safsa', 'safsa@dsgds.com');
        $this->assertCount(1, $user->recordedMessages());
    }
}
