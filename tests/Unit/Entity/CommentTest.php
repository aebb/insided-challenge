<?php

namespace InSided\Solution\Unit\Entity;

use DateTime;
use InSided\Solution\Entity\Comment;
use InSided\Solution\Entity\Post;
use InSided\Solution\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \InSided\Solution\Entity\Comment
 */
class CommentTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getOwner
     */
    public function testGet()
    {
        $user = $this->createMock(User::class);
        $comment = new Comment(
            'CONTENT',
            $user,
            $this->createMock(Post::class),
        );

        $this->assertEquals($user, $comment->getOwner());
    }
}
