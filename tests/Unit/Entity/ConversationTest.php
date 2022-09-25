<?php

namespace InSided\Solution\Unit\Entity;

use DateTime;
use InSided\Solution\Entity\Comment;
use InSided\Solution\Entity\Conversation;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \InSided\Solution\Entity\Conversation
 */
class ConversationTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::addComment
     */
    public function testAddComment()
    {
        $post = new Conversation(
            'content',
            null,
            [],
            1,
            new DateTime('2022-01-01 00:00:00'),
            new DateTime('2022-01-02 00:00:00'),
        );

        $comment = $this->createMock(Comment::class);
        $comment->method('getId')->willReturn('123');

        $this->assertEquals($comment, $post->addComment($comment));
    }
}
