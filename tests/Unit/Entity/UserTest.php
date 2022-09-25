<?php

namespace InSided\Solution\Unit\Entity;

use DateTime;
use InSided\Solution\Entity\Comment;
use InSided\Solution\Entity\Conversation;
use InSided\Solution\Entity\User;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

/**
 * @coversDefaultClass \InSided\Solution\Entity\User
 */
class UserTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::isModerator
     * @covers ::getUsername
     */
    public function testUser()
    {
        $username = 'foobar';
        $user = new User($username);

        $this->assertEquals($username, $user->getUsername());
        $this->assertFalse($user->isModerator());
    }
}
