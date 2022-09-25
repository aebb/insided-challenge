<?php

namespace InSided\Solution\Unit\Request\Article;

use InSided\Solution\Entity\Article;
use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\Article\CreateArticleCommand;
use InSided\Solution\Utils\AppException;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

/**
 * @coversDefaultClass \InSided\Solution\Request\Post\Article\CreateArticleCommand
 */
class CreateArticleCommandTest extends TestCase
{
    /**
     * @covers::__construct
     * @covers::getUser
     * @covers::getCommunityId
     * @covers::getData
     * @covers::getType
     * @covers::validate
     */
    public function testCommand()
    {
        $user = $this->createMock(User::class);
        $id = '123';
        $content = 'content';
        $title = 'title';

        $model = new CreateArticleCommand($user, $id, $content, $title);

        $data = [
            'owner'   => $user,
            'content' => $content,
            'title'   => $title,
        ];

        $this->assertEquals($user, $model->getUser());
        $this->assertEquals($id, $model->getCommunityId());
        $this->assertEquals(Article::class, $model->getType());
        $this->assertEquals($data, $model->getData());
        $this->assertTrue($model->validate());
    }

    /**
     * @covers::__construct
     * @covers::validate
     */
    public function testInvalidId()
    {
        $user = $this->createMock(User::class);
        $id = '';
        $content = 'content';
        $title = 'title';

        $model = new CreateArticleCommand($user, $id, $content, $title);

        $this->expectException(AppException::class);
        $model->validate();
    }

    public function testInvalidContent()
    {
        $user = $this->createMock(User::class);
        $id = '123';
        $content = '';
        $title = 'title';

        $model = new CreateArticleCommand($user, $id, $content, $title);

        $this->expectException(AppException::class);
        $model->validate();
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

        $model = new CreateArticleCommand($user, $id, $content, $title);

        $this->expectException(AppException::class);
        $model->validate();
    }

    /**
     * @covers::__construct
     * @covers::validate
     */
    public function testInvalidUser()
    {
        $user = $this->createMock(User::class);
        $id = '123';
        $content = 'content';
        $title = '';

        $model = new CreateArticleCommand($user, $id, $content, $title);

        $this->expectException(AppException::class);
        $model->validate();
    }
}
