<?php

namespace InSided\Solution\Unit\Controller;

use Exception;
use InSided\Solution\Controller\CommentController;
use InSided\Solution\Entity\Comment;
use InSided\Solution\Entity\Post;
use InSided\Solution\Entity\User;
use InSided\Solution\Request\Base\AbstractCommand;
use InSided\Solution\Request\Comment\CreateCommentCommand;
use InSided\Solution\Request\Factory\CommentCommandFactoryInterface;
use InSided\Solution\Service\CommentService;
use InSided\Solution\Utils\Controller;
use InSided\Solution\Utils\ValidatorInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @coversDefaultClass \InSided\Solution\Controller\CommentController
 */
class CommentControllerTest extends TestCase
{
    private ValidatorInterface $validator;

    private ResponseFactoryInterface $responseFactory;

    private CommentService $service;

    private CommentCommandFactoryInterface $actionFactory;

    private CommentController $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->responseFactory  = $this->createMock(ResponseFactoryInterface::class);
        $this->service  = $this->createMock(CommentService::class);
        $this->actionFactory  = $this->createMock(CommentCommandFactoryInterface::class);

        $this->sut = new CommentController(
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
     * @covers::createAction
     */
    public function testCreate()
    {
        $command = $this->createMock(CreateCommentCommand::class);

        $this->actionFactory->method('createCommentAction')
            ->willReturn($command);

        $this->validator->method('validate')->willReturn($command);


        $request = $this->createMock(ServerRequestInterface::class);

        $comment = new Comment(
            'content',
            $this->createMock(User::class),
            $this->createMock(Post::class),
        );

        $this->service->method('createComment')->willReturn($comment);


        $this->expectException(\Error::class);

        try {
            $this->sut->createAction($request);
        } catch (Exception $exception) {
        }
    }
}
