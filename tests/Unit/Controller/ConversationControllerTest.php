<?php

namespace InSided\Solution\Unit\Controller;

use Exception;
use InSided\Solution\Controller\ConversationController;
use InSided\Solution\Entity\Conversation;
use InSided\Solution\Request\Factory\ConversationCommandFactoryInterface;
use InSided\Solution\Request\Post\Conversation\CreateConversationCommand;
use InSided\Solution\Request\Post\Conversation\DeleteConversationCommand;
use InSided\Solution\Request\Post\Conversation\ListConversationCommand;
use InSided\Solution\Request\Post\Conversation\UpdateConversationCommand;
use InSided\Solution\Service\ConversationService;
use InSided\Solution\Utils\ValidatorInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @coversDefaultClass \InSided\Solution\Controller\ConversationController
 */
class ConversationControllerTest extends TestCase
{
    private ValidatorInterface $validator;

    private ResponseFactoryInterface $responseFactory;

    private ConversationService $service;

    private ConversationCommandFactoryInterface $actionFactory;

    private ConversationController $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->responseFactory  = $this->createMock(ResponseFactoryInterface::class);
        $this->service  = $this->createMock(ConversationService::class);
        $this->actionFactory  = $this->createMock(ConversationCommandFactoryInterface::class);

        $this->sut = new ConversationController(
            $this->validator,
            $this->responseFactory,
            $this->service,
            $this->actionFactory,
        );

        $this->response = $this->createMock(ResponseInterface::class);

        $this->stream = $this->createMock(StreamInterface::class);
    }


    /**
     * @covers::__construct
     * @covers::listAction
     */
    public function testList()
    {
        $command = $this->createMock(ListConversationCommand::class);

        $this->actionFactory->method('listConversationAction')
            ->willReturn($command);

        $this->validator->method('validate')->willReturn($command);


        $request = $this->createMock(ServerRequestInterface::class);

        $conversation = [];

        $this->service->method('list')->willReturn($conversation);


        $this->expectException(\Error::class);

        try {
            $this->sut->listAction($request);
        } catch (Exception $exception) {
        }
    }


    /**
     * @covers::__construct
     * @covers::createAction
     */
    public function testCreate()
    {
        $command = $this->createMock(CreateConversationCommand::class);

        $this->actionFactory->method('createConversationAction')
            ->willReturn($command);

        $this->validator->method('validate')->willReturn($command);


        $request = $this->createMock(ServerRequestInterface::class);

        $conversation = $this->createMock(Conversation::class);

        $this->service->method('create')->willReturn($conversation);


        $this->expectException(\Error::class);

        try {
            $this->sut->createAction($request);
        } catch (Exception $exception) {
        }
    }

    /**
     * @covers::__construct
     * @covers::updateAction
     */
    public function testUpdate()
    {
        $command = $this->createMock(UpdateConversationCommand::class);

        $this->actionFactory->method('updateConversationAction')
            ->willReturn($command);

        $this->validator->method('validate')->willReturn($command);


        $request = $this->createMock(ServerRequestInterface::class);

        $conversation = $this->createMock(Conversation::class);

        $this->service->method('update')->willReturn($conversation);


        $this->expectException(\Error::class);

        try {
            $this->sut->updateAction($request);
        } catch (Exception $exception) {
        }
    }

    /**
     * @covers::__construct
     * @covers::deleteAction
     */
    public function testDelete()
    {
        $command = $this->createMock(DeleteConversationCommand::class);

        $this->actionFactory->method('deleteConversationAction')
            ->willReturn($command);

        $this->validator->method('validate')->willReturn($command);


        $request = $this->createMock(ServerRequestInterface::class);

        $conversation = $this->createMock(Conversation::class);

        $this->service->method('delete')->willReturn($conversation);


        $this->expectException(\Error::class);

        try {
            $this->sut->deleteAction($request);
        } catch (Exception $exception) {
        }
    }
}
