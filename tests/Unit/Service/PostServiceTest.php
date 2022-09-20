<?php

namespace InSided\Solution\Unit\Service;

use InSided\Solution\Entity\Community;
use InSided\Solution\Entity\Post;
use InSided\Solution\Entity\User;
use InSided\Solution\Repository\CommunityRepositoryInMemory;
use InSided\Solution\Request\Post\Conversation\CreateConversationCommand;
use InSided\Solution\Service\PostService;
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
        $this->repository->save(new Community('test', [], '123'));

        $this->sut = new PostService($this->logger, $this->repository);
    }

    /**
     * @covers::create
     */
    public function testCreateAction()
    {
        $user = $this->createMock(User::class);
        $communityId = '123';
        $content = 'foobar';

        $command = new CreateConversationCommand($user, $communityId, $content);

        $post = $this->sut->create($command);

        $this->assertInstanceOf(Post::class, $post);
    }

}
