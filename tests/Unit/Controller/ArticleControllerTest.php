<?php

namespace InSided\Solution\Unit\Controller;

use Exception;
use InSided\Solution\Controller\ArticleController;
use InSided\Solution\Entity\Article;
use InSided\Solution\Request\Factory\ArticleCommandFactoryInterface;
use InSided\Solution\Request\Post\Article\CreateArticleCommand;
use InSided\Solution\Request\Post\Article\DeleteArticleCommand;
use InSided\Solution\Request\Post\Article\EnableArticleCommand;
use InSided\Solution\Request\Post\Article\ListArticleCommand;
use InSided\Solution\Request\Post\Article\UpdateArticleCommand;
use InSided\Solution\Service\ArticleService;
use InSided\Solution\Utils\ValidatorInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @coversDefaultClass \InSided\Solution\Controller\ArticleController
 */
class ArticleControllerTest extends TestCase
{
    private ValidatorInterface $validator;

    private ResponseFactoryInterface $responseFactory;

    private ArticleService $service;

    private ArticleCommandFactoryInterface $actionFactory;

    private ArticleController $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->responseFactory  = $this->createMock(ResponseFactoryInterface::class);
        $this->service  = $this->createMock(ArticleService::class);
        $this->actionFactory  = $this->createMock(ArticleCommandFactoryInterface::class);

        $this->sut = new ArticleController(
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
        $command = $this->createMock(ListArticleCommand::class);

        $this->actionFactory->method('listArticleAction')
            ->willReturn($command);

        $this->validator->method('validate')->willReturn($command);


        $request = $this->createMock(ServerRequestInterface::class);

        $article = [];

        $this->service->method('list')->willReturn($article);


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
        $command = $this->createMock(CreateArticleCommand::class);

        $this->actionFactory->method('createArticleAction')
            ->willReturn($command);

        $this->validator->method('validate')->willReturn($command);


        $request = $this->createMock(ServerRequestInterface::class);

        $article = $this->createMock(Article::class);

        $this->service->method('create')->willReturn($article);


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
        $command = $this->createMock(UpdateArticleCommand::class);

        $this->actionFactory->method('updateArticleAction')
            ->willReturn($command);

        $this->validator->method('validate')->willReturn($command);


        $request = $this->createMock(ServerRequestInterface::class);

        $article = $this->createMock(Article::class);

        $this->service->method('update')->willReturn($article);


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
        $command = $this->createMock(DeleteArticleCommand::class);

        $this->actionFactory->method('deleteArticleAction')
            ->willReturn($command);

        $this->validator->method('validate')->willReturn($command);


        $request = $this->createMock(ServerRequestInterface::class);

        $article = $this->createMock(Article::class);

        $this->service->method('delete')->willReturn($article);


        $this->expectException(\Error::class);

        try {
            $this->sut->deleteAction($request);
        } catch (Exception $exception) {
        }
    }

    /**
     * @covers::__construct
     * @covers::enableCommentsAction
     */
    public function testEnable()
    {
        $command = $this->createMock(EnableArticleCommand::class);

        $this->actionFactory->method('enableArticleAction')
            ->willReturn($command);

        $this->validator->method('validate')->willReturn($command);


        $request = $this->createMock(ServerRequestInterface::class);

        $article = $this->createMock(Article::class);

        $this->service->method('enableComments')->willReturn($article);


        $this->expectException(\Error::class);

        try {
            $this->sut->enableCommentsAction($request);
        } catch (Exception $exception) {
        }
    }
}
