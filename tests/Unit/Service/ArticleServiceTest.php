<?php

namespace InSided\Solution\Unit\Service;

use InSided\Solution\Entity\Article;
use InSided\Solution\Entity\Comment;
use InSided\Solution\Entity\Community;
use InSided\Solution\Entity\Conversation;
use InSided\Solution\Entity\Post;
use InSided\Solution\Entity\User;
use InSided\Solution\Repository\CommunityRepositoryInMemory;
use InSided\Solution\Request\Post\Article\EnableArticleCommand;
use InSided\Solution\Request\Post\Conversation\CreateConversationCommand;
use InSided\Solution\Request\Post\Conversation\DeleteConversationCommand;
use InSided\Solution\Request\Post\Conversation\ListConversationCommand;
use InSided\Solution\Request\Post\Conversation\UpdateConversationCommand;
use InSided\Solution\Service\ArticleService;
use InSided\Solution\Service\PostService;
use InSided\Solution\Utils\AppException;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use ReflectionProperty;

/**
 * @coversDefaultClass \InSided\Solution\Service\ArticleService
 */
class ArticleServiceTest extends TestCase
{
    private ArticleService $sut;

    private LoggerInterface $logger;
    private CommunityRepositoryInMemory $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->logger     = $this->createMock(LoggerInterface::class);
        $this->repository = new CommunityRepositoryInMemory();

        $this->sut = new ArticleService($this->logger, $this->repository);
    }

    /**
     * @covers ::__construct
     * @covers ::enableComments
     * @covers ::getPost
     * @covers ::getCommunity
     * @covers ::hasRights
     * @covers ::getArticle
     */
    public function testUpdateAction()
    {
        $communityId = '123';
        $userId = '321';
        $postId = '213';

        $community = new Community('test', [], $communityId);
        $user = new User('user1', [], $userId);
        $post = new Article(
            'title',
            'content',
            true,
            $user,
            [
                '1' => $this->createMock(Comment::class),
                '2' => $this->createMock(Comment::class),
                '3' => $this->createMock(Comment::class),
            ],
            $postId
        )
        ;

        $community->savePost($post);
        $this->repository->save($community);

        $command = new EnableArticleCommand($user, $communityId, $postId);
        $post = $this->sut->enableComments($command);

        $this->assertEquals($post, $this->repository->findCommunityById($communityId)->fetchPost($post->getId()));

        $prop = new ReflectionProperty($post, 'comments');
        $prop->setAccessible(true);
        $this->assertNotEmpty($prop->getValue($post));
    }
}
