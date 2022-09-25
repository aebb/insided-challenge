<?php

namespace InSided\Solution\Unit\Request\Article;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\Article\UpdateArticleCommand;
use InSided\Solution\Utils\AppException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \InSided\Solution\Request\Post\Article\UpdateArticleCommand
 */
class UpdateArticleCommandTest extends TestCase
{
    /**
     * @covers::__construct
     * @covers::getUser
     * @covers::getCommunityId
     * @covers::getPostId
     * @covers::getData
     * @covers::validate
     * @covers ::validatePostId
     */
    public function testCommand()
    {
        $user = $this->createMock(User::class);
        $id = '123';
        $id2 = '123';
        $content = 'content';
        $title = 'title';

        $model = new UpdateArticleCommand($user, $id, $id2, $content, $title);

        $data = [
            'content' => $content,
            'title'   => $title,
        ];

        $this->assertEquals($user, $model->getUser());
        $this->assertEquals($id, $model->getCommunityId());
        $this->assertEquals($id2, $model->getPostId());
        $this->assertEquals($data, $model->getData());
        $this->assertTrue($model->validate());
    }

    /**
     * @covers::__construct
     * @covers::validate
     */
    public function testInvalidTitle()
    {
        $user = $this->createMock(User::class);
        $id = '123';
        $content = 'content';
        $title = '';

        $model = new UpdateArticleCommand($user, $id, $id, $content, '');

        $this->expectException(AppException::class);
        $model->validate();
    }

    /**
     * @covers::__construct
     * @covers::validate
     */
    public function testInvalidPostId()
    {
        $user = $this->createMock(User::class);
        $id = '123';
        $content = 'content';
        $title = 'title';

        $model = new UpdateArticleCommand($user, $id, '', $content, '');

        $this->expectException(AppException::class);
        $model->validate();
    }
}
