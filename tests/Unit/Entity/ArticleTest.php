<?php

namespace InSided\Solution\Unit\Entity;

use DateTime;
use InSided\Solution\Entity\Article;
use InSided\Solution\Entity\Comment;
use InSided\Solution\Entity\User;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

/**
 * @coversDefaultClass \InSided\Solution\Entity\Article
 * @covers \InSided\Solution\Entity\Post
 * @covers \InSided\Solution\Entity\Model
 */
class ArticleTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::setData
     * @covers ::getOwner
     */
    public function testData()
    {
        $user = $this->createMock(User::class);
        $post = new Article(
            'title',
            'content',
            true,
            $user,
            [],
            1,
            new DateTime('2022-01-01 00:00:00'),
            new DateTime('2022-01-02 00:00:00'),
        );

        $data = ['title' => 'title2', 'content' => 'content2'];

        $post->setData($data);

        $prop = new ReflectionProperty($post, 'title');
        $prop->setAccessible(true);
        $this->assertEquals($data['title'], $prop->getValue($post));


        $prop = new ReflectionProperty($post, 'content');
        $prop->setAccessible(true);
        $this->assertEquals($data['content'], $prop->getValue($post));

        $this->assertEquals($user, $post->getOwner());
    }

    /**
     * @covers ::__construct
     * @covers ::addComment
     * @covers ::enableComments
     */
    public function testAddComment()
    {
        $post = new Article(
            'title',
            'content',
            true,
            null,
            [],
            1,
            new DateTime('2022-01-01 00:00:00'),
            new DateTime('2022-01-02 00:00:00'),
        );

        $comment = $this->createMock(Comment::class);
        $comment->method('getId')->willReturn('123');

        $this->assertEquals($comment, $post->addComment($comment));

        $post->enableComments(false);

        $this->assertNull($post->addComment($comment));

        $prop = new ReflectionProperty($post, 'comments');
        $prop->setAccessible(true);
        $this->assertCount(1, $prop->getValue($post));
    }

    /**
     * @covers ::__construct
     * @covers ::jsonSerialize
     */
    public function testJson()
    {
        $post = new Article(
            'title',
            'content',
            true,
            new User('joe'),
            [],
            1,
            new DateTime('2022-01-01 00:00:00'),
            new DateTime('2022-01-02 00:00:00'),
        );

        $json = [
            'id' => '1',
            'content' => 'content',
            'title' => 'title',
            'enableComments' => true,
            'owner' => 'joe',
            'createdAt' => '2022-01-01 00:00:00',
            'updatedAt' => '2022-01-02 00:00:00',
        ];

        $result = $post->jsonSerialize();
        $this->assertEquals($json, $result);
    }
}
