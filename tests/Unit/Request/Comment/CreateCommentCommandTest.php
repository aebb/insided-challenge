<?php

namespace InSided\Solution\Unit\Request\Comment;

use InSided\Solution\Entity\Article;
use InSided\Solution\Entity\User;
use InSided\Solution\Request\Comment\CreateCommentCommand;
use InSided\Solution\Request\Post\Article\CreateArticleCommand;
use InSided\Solution\Utils\AppException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \InSided\Solution\Request\Comment\CreateCommentCommand
 */
class CreateCommentCommandTest extends TestCase
{
    /**
     * @covers::__construct
     * @covers ::getContent
     * @covers::validate
     * @covers ::validateContent
     */
    public function testCommand()
    {
        $user = $this->createMock(User::class);
        $id = '123';
        $postId = '123';
        $content = 'content';

        $model = new CreateCommentCommand($user, $id, $postId, $content);

        $data = $content;

        $this->assertEquals($data, $model->getContent());
        $this->assertTrue($model->validate());
    }

    /**
     * @covers::__construct
     * @covers::validate
     */
    public function testInvalid()
    {
        $user = $this->createMock(User::class);
        $id = '123';
        $postId = '123';
        $content = '';

        $model = new CreateCommentCommand($user, $id, $postId, $content);

        $this->expectException(AppException::class);
        $model->validate();
    }
}
