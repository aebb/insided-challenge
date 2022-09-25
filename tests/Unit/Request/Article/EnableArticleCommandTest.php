<?php

namespace InSided\Solution\Unit\Request\Article;

use InSided\Solution\Entity\Article;
use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\Article\CreateArticleCommand;
use InSided\Solution\Request\Post\Article\EnableArticleCommand;
use InSided\Solution\Utils\AppException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \InSided\Solution\Request\Post\Article\EnableArticleCommand
 */
class EnableArticleCommandTest extends TestCase
{
    /**
     * @covers::__construct
     * @covers::getData
     */
    public function testCommand()
    {
        $user = $this->createMock(User::class);
        $id = '123';
        $content = 'content';
        $title = 'title';

        $model = new EnableArticleCommand($user, $id, $content);

        $this->assertEquals(false, $model->getData());
    }
}
