<?php

namespace InSided\Solution\Unit\Request\Conversation;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\Conversation\UpdateConversationCommand;
use InSided\Solution\Utils\AppException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \InSided\Solution\Request\Post\Conversation\UpdateConversationCommand
 */
class UpdateConversationCommandTest extends TestCase
{
    /**
     * @covers::__construct
     * @covers::validate
     * @covers::validateContent
     */
    public function testCommand()
    {
        $user = $this->createMock(User::class);
        $id = '123';
        $id2 = '123';
        $content = 'content';

        $model = new UpdateConversationCommand($user, $id, $id2, $content);

        $data = [
            'content' => $content,
        ];

        $this->assertEquals($data, $model->getData());
        $this->assertTrue($model->validate());
    }

    /**
     * @covers::__construct
     * @covers::validate
     * @covers::validateContent
     */
    public function testInvalidContent()
    {
        $user = $this->createMock(User::class);
        $id = '123';
        $id2 = '123';
        $content = '';

        $model = new UpdateConversationCommand($user, $id, $id2, $content);

        $data = [
            'content' => $content,
        ];

        $this->expectException(AppException::class);
        $model->validate();
    }
}
