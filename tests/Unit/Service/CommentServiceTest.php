<?php

namespace InSided\Solution\Unit\Service;

use InSided\Solution\Entity\Article;
use InSided\Solution\Entity\Comment;
use InSided\Solution\Entity\Community;
use InSided\Solution\Entity\User;
use InSided\Solution\Repository\CommunityRepositoryInMemory;
use InSided\Solution\Request\Comment\CreateCommentCommand;
use InSided\Solution\Request\Post\Article\EnableArticleCommand;
use InSided\Solution\Service\ArticleService;
use InSided\Solution\Service\CommentService;
use InSided\Solution\Utils\AppException;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use ReflectionProperty;

/**
 * @coversDefaultClass \InSided\Solution\Service\CommentService
 */
class CommentServiceTest extends TestCase
{
    private CommentService $sut;

    private LoggerInterface $logger;
    private CommunityRepositoryInMemory $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->logger     = $this->createMock(LoggerInterface::class);
        $this->repository = new CommunityRepositoryInMemory();

        $this->sut = new CommentService($this->logger, $this->repository);
    }

    /**
     * @covers ::__construct
     * @covers ::createComment
     * @covers ::getPost
     * @covers ::getCommunity
     */
    public function testCreateAction()
    {
        $communityId = '123';
        $userId = '321';
        $postId = '213';

        $community = new Community('test', [], $communityId);
        $user = new User('user1', [], $userId);
        $post = new Article('title', 'content', true, $user, [], $postId);

        $community->savePost($post);
        $this->repository->save($community);

        $command = new CreateCommentCommand($user, $communityId, $postId, 'content');
        $comment = $this->sut->createComment($command);

        $this->assertInstanceOf(Comment::class, $comment);

        $prop = new ReflectionProperty($post, 'comments');
        $prop->setAccessible(true);
        $this->assertNotEmpty($prop->getValue($post));
    }

    /**
     * @covers ::__construct
     * @covers ::createComment
     * @covers ::getPost
     * @covers ::getCommunity
     */
    public function testCreateFailAction()
    {
        $communityId = '123';
        $userId = '321';
        $postId = '213';

        $community = new Community('test', [], $communityId);
        $user = new User('user1', [], $userId);
        $post = new Article('title', 'content', false, $user, [], $postId);

        $community->savePost($post);
        $this->repository->save($community);

        $command = new CreateCommentCommand($user, $communityId, $postId, 'content');
        $this->expectException(AppException::class);

        $this->sut->createComment($command);


        $prop = new ReflectionProperty($post, 'comments');
        $prop->setAccessible(true);
        $this->assertEmpty($prop->getValue($post));
    }
}
