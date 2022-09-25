<?php

namespace InSided\Solution\Unit\Service;

use InSided\Solution\Entity\Article;
use InSided\Solution\Entity\Community;
use InSided\Solution\Entity\Conversation;
use InSided\Solution\Entity\Post;
use InSided\Solution\Entity\Roles;
use InSided\Solution\Entity\User;
use InSided\Solution\Repository\CommunityRepositoryInMemory;
use InSided\Solution\Request\Post\Conversation\CreateConversationCommand;
use InSided\Solution\Request\Post\Conversation\DeleteConversationCommand;
use InSided\Solution\Request\Post\Conversation\ListConversationCommand;
use InSided\Solution\Request\Post\Conversation\UpdateConversationCommand;
use InSided\Solution\Service\PostService;
use InSided\Solution\Utils\AppException;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

/**
 * @coversDefaultClass \InSided\Solution\Service\PostService
 */
class PostServiceTest extends TestCase
{
    private PostService $sut;

    private LoggerInterface $logger;
    private CommunityRepositoryInMemory $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->logger     = $this->createMock(LoggerInterface::class);
        $this->repository = new CommunityRepositoryInMemory();

        $this->sut = new PostService($this->logger, $this->repository);
    }

    /**
     * @covers::list
     */
    public function testListAction()
    {
        $communityId = '123';
        $community = new Community('test', [], $communityId);

        $user = $this->createMock(User::class);

        $community->savePost(new Conversation());
        $community->savePost(new Article());
        $community->savePost(new Article());
        $community->savePost(new Article());
        $community->savePost(new Conversation());

        $this->repository->save($community);

        $command = new ListConversationCommand($user, $communityId);

        $posts = $this->sut->list($command);

        $this->assertCount(2, $posts);
    }

    /**
     * @covers::create
     */
    public function testCreateAction()
    {
        $communityId = '123';
        $content = 'foobar';
        $this->repository->save(new Community('test', [], $communityId));

        $user = $this->createMock(User::class);

        $command = new CreateConversationCommand($user, $communityId, $content);

        $post = $this->sut->create($command);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertInstanceOf(Conversation::class, $post);

        $this->assertEquals($post, $this->repository->findCommunityById($communityId)->fetchPost($post->getId()));
    }

    /**
     * @covers ::update
     * @covers ::getPost
     * @covers ::getCommunity
     * @covers ::hasRights
     */
    public function testUpdateAction()
    {
        $communityId = '123';
        $userId = '321';
        $postId = '213';

        $community = new Community('test', [], $communityId);
        $user = new User('user1', [], $userId);
        $post = new Conversation('content', $user, [], $postId);

        $community->savePost($post);
        $this->repository->save($community);

        $command = new UpdateConversationCommand($user, $communityId, $postId, 'new content');
        $post = $this->sut->update($command);

        $this->assertEquals($post, $this->repository->findCommunityById($communityId)->fetchPost($post->getId()));
    }

    /**
     * @covers ::delete
     * @covers ::getPost
     * @covers ::getCommunity
     * @covers ::hasRights
     */
    public function testDeleteAction()
    {
        $communityId = '123';
        $userId = '321';
        $postId = '213';

        $community = new Community('test', [], $communityId);
        $user = new User('user1', [], $userId);
        $post = new Conversation('content', $user, [], $postId);

        $community->savePost($post);
        $this->repository->save($community);

        $command = new DeleteConversationCommand($user, $communityId, $postId);
        $post = $this->sut->delete($command);


        $this->assertNull($this->repository->findCommunityById($communityId)->fetchPost($post->getId()));
    }

    /**
     * @covers ::hasRights
     */
    public function testModPermission()
    {
        $communityId = '123';
        $userId = '321';
        $postId = '213';

        $community = new Community('test', [], $communityId);

        $user1 = new User('user1', [Roles::Moderator], $userId);
        $user2 = new User('user2', [], $userId . '123');

        $post = new Conversation('content', $user2, [], $postId);

        $community->savePost($post);
        $this->repository->save($community);

        $command = new DeleteConversationCommand($user1, $communityId, $postId);

        $post = $this->sut->delete($command);
        $this->assertNull($this->repository->findCommunityById($communityId)->fetchPost($post->getId()));
    }

    /**
     * @covers ::getCommunity
     */
    public function testNoCommunity()
    {
        $communityId = '123';
        $userId = '321';
        $postId = '213';

        $community = new Community('test', [], $communityId);

        $user1 = new User('user1', [], $userId);

        $post = new Conversation('content', $user1, [], $postId);

        $community->savePost($post);
        $this->repository->save($community);

        $command = new DeleteConversationCommand($user1, $communityId . '321', $postId);

        $this->expectException(AppException::class);

        $post = $this->sut->delete($command);
    }

    /**
     * @covers ::getPost
     */
    public function testNoPost()
    {
        $communityId = '123';
        $userId = '321';
        $postId = '213';

        $community = new Community('test', [], $communityId);
        $user = new User('user1', [], $userId);
        $post = new Conversation('content', $user, [], $postId . '321');

        $community->savePost($post);
        $this->repository->save($community);

        $command = new DeleteConversationCommand($user, $communityId, $postId);

        $this->expectException(AppException::class);

        $post = $this->sut->delete($command);
    }

    /**
     * @covers ::hasRights
     */
    public function testNoPermission()
    {
        $communityId = '123';
        $userId = '321';
        $postId = '213';

        $community = new Community('test', [], $communityId);

        $user1 = new User('user1', [], $userId);
        $user2 = new User('user2', [], $userId . '123');

        $post = new Conversation('content', $user2, [], $postId);

        $community->savePost($post);
        $this->repository->save($community);

        $command = new DeleteConversationCommand($user1, $communityId, $postId);

        $this->expectException(AppException::class);

        $post = $this->sut->delete($command);
    }
}
