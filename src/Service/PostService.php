<?php

namespace InSided\Solution\Service;

use Exception;
use InSided\Solution\Entity\Community;
use InSided\Solution\Entity\Post;
use InSided\Solution\Entity\User;
use InSided\Solution\Repository\CommunityRepositoryInterface;
use InSided\Solution\Request\Post\CreatePostAction;
use InSided\Solution\Request\Post\DeletePostAction;
use InSided\Solution\Request\Post\ListPostAction;
use InSided\Solution\Request\Post\UpdatePostAction;
use JsonSerializable;
use Psr\Log\LoggerInterface;

class PostService extends AbstractService
{
    public function __construct(LoggerInterface $logger, protected readonly CommunityRepositoryInterface $communityRepository)
    {
        parent::__construct($logger);
    }

    /**
     * @throws Exception
     */
    public function list(ListPostAction $action): array
    {
        $community = $this->getCommunity($action->getCommunityId());

        return $community->listPosts($action->getType());
    }

    /**
     * @throws Exception
     */
    public function create(CreatePostAction $action): JsonSerializable
    {
        $community = $this->getCommunity($action->getCommunityId());

        $post = new $action->getPostType();

        $post->setData($action->getData());
        $post->setOwner($action->getUser());

        return $community->savePost($post);
    }

    /**
     * @throws Exception
     */
    public function update(UpdatePostAction $action): JsonSerializable
    {
        $user      = $action->getUser();
        $community = $this->getCommunity($action->getCommunityId());
        $post      = $this->getPost($community, $action->getPostId());

        $this->hasRights($user, $post);
        $post->setData($action->getData());

        return $community->savePost($post);
    }

    /**
     * @throws Exception
     */
    public function delete(DeletePostAction $action): JsonSerializable
    {
        $user      = $action->getUser();
        $community = $this->getCommunity($action->getCommunityId());
        $post      = $this->getPost($community, $action->getPostId());

        $this->hasRights($user, $post);

        return $community->removePost($post);
    }

    /**
     * @throws Exception
     */
    protected function getCommunity(string $communityId): ?Community
    {
        $community = $this->communityRepository->findCommunityById($communityId);
        if(!$community) {
            $this->logger->error('foo-bar');
            throw new Exception("community not found", 404);

        }

        return $community;
    }

    /**
     * @throws Exception
     */
    protected function getPost(Community $community, string $postId): ?Post
    {
        $post = $community->fetchPost($postId);
        if(!$post) {
            $this->logger->error('foo-bar');
            throw new Exception("post not found", 404);
        }

        return $post;
    }

    /**
     * @throws Exception
     */
    protected function hasRights(User $user, Post $post): bool
    {
        if($post->getOwner()->getI() == $user->getId())
        {
            return true;
        }

        $this->logger->error('foo-bar');
        throw new Exception("no auth", 401);
    }
}
