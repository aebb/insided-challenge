<?php

namespace InSided\Solution\Unit\Request\Factory;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Factory\RequestCommandFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @coversDefaultClass \InSided\Solution\Request\Factory\RequestCommandFactory
 */
class RequestCommandFactoryTest extends TestCase
{
    private RequestCommandFactory $sut;

    private ServerRequestInterface $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->sut = new RequestCommandFactory();
        $this->request = $this->createMock(ServerRequestInterface::class);
    }

    /**
     * @covers::__construct
     * @covers::createArticleAction
     */
    public function testCreateArticleAction()
    {
        $this->request
            ->expects($this->exactly(2))
            ->method('getAttribute')
            ->withConsecutive(['user'], ['community-id'])
            ->willReturnOnConsecutiveCalls($this->createMock(User::class), 'community-id');

        $this->request
            ->method('getParsedBody')
            ->willReturn(['title' => 'title', 'content' => 'content']);

        $this->sut->createArticleAction($this->request);
    }

    /**
     * @covers::__construct
     * @covers::deleteArticleAction
     */
    public function testDeleteArticleAction()
    {
        $this->request
            ->expects($this->exactly(3))
            ->method('getAttribute')
            ->withConsecutive(['user'], ['community-id'], ['article-id'])
            ->willReturnOnConsecutiveCalls(
                $this->createMock(User::class),
                'community-id',
                'article-id'
            );

        $this->sut->deleteArticleAction($this->request);
    }

    /**
     * @covers::__construct
     * @covers::enableArticleAction
     */
    public function testEnableArticleAction()
    {
        $this->request
            ->expects($this->exactly(3))
            ->method('getAttribute')
            ->withConsecutive(['user'], ['community-id'], ['article-id'])
            ->willReturnOnConsecutiveCalls(
                $this->createMock(User::class),
                'community-id',
                'article-id'
            );


        $this->sut->enableArticleAction($this->request);
    }

    /**
     * @covers::__construct
     * @covers::listArticleAction
     */
    public function testListArticleAction()
    {
        $this->request
            ->expects($this->exactly(2))
            ->method('getAttribute')
            ->withConsecutive(['user'], ['community-id'])
            ->willReturnOnConsecutiveCalls($this->createMock(User::class), 'community-id');

        $this->sut->listArticleAction($this->request);
    }

    /**
     * @covers::__construct
     * @covers::updateArticleAction
     */
    public function testUpdateArticleAction()
    {
        $this->request
            ->expects($this->exactly(3))
            ->method('getAttribute')
            ->withConsecutive(['user'], ['community-id'], ['article-id'])
            ->willReturnOnConsecutiveCalls(
                $this->createMock(User::class),
                'community-id',
                'article-id'
            );

        $this->request
            ->method('getParsedBody')
            ->willReturn(['title' => 'title', 'content' => 'content']);

        $this->sut->updateArticleAction($this->request);
    }

    /**
     * @covers::__construct
     * @covers::createConversationAction
     */
    public function testCreateConversationAction()
    {
        $this->request
            ->expects($this->exactly(2))
            ->method('getAttribute')
            ->withConsecutive(['user'], ['community-id'])
            ->willReturnOnConsecutiveCalls($this->createMock(User::class), 'community-id');

        $this->request
            ->method('getParsedBody')
            ->willReturn(['content' => 'content']);

        $this->sut->createConversationAction($this->request);
    }

    /**
     * @covers::__construct
     * @covers::deleteConversationAction
     */
    public function testDeleteConversationAction()
    {
        $this->request
            ->expects($this->exactly(3))
            ->method('getAttribute')
            ->withConsecutive(['user'], ['community-id'], ['conversation-id'])
            ->willReturnOnConsecutiveCalls(
                $this->createMock(User::class),
                'community-id',
                'conversation-id'
            );

        $this->sut->deleteConversationAction($this->request);
    }

    /**
     * @covers::__construct
     * @covers::listConversationAction
     */
    public function testListConversationAction()
    {
        $this->request
            ->expects($this->exactly(2))
            ->method('getAttribute')
            ->withConsecutive(['user'], ['community-id'])
            ->willReturnOnConsecutiveCalls($this->createMock(User::class), 'community-id');

        $this->sut->listConversationAction($this->request);
    }

    /**
     * @covers::__construct
     * @covers::updateConversationAction
     */
    public function testUpdateConversationAction()
    {
        $this->request
            ->expects($this->exactly(3))
            ->method('getAttribute')
            ->withConsecutive(['user'], ['community-id'], ['conversation-id'])
            ->willReturnOnConsecutiveCalls(
                $this->createMock(User::class),
                'community-id',
                'conversation-id'
            );

        $this->request
            ->method('getParsedBody')
            ->willReturn(['content' => 'content']);

        $this->sut->updateConversationAction($this->request);
    }

    /**
     * @covers::__construct
     * @covers::createCommentAction
     */
    public function testCreateCommentAction()
    {
        $this->request
            ->expects($this->exactly(3))
            ->method('getAttribute')
            ->withConsecutive(['user'], ['community-id'], ['post-id'])
            ->willReturnOnConsecutiveCalls(
                $this->createMock(User::class),
                'community-id',
                'post-id'
            );

        $this->request
            ->method('getParsedBody')
            ->willReturn(['title' => 'title', 'content' => 'content']);

        $this->sut->createCommentAction($this->request);
    }
}
