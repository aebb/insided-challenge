<?php

namespace InSided\Solution\Service;

use Exception;
use InSided\Solution\Entity\Post;
use InSided\Solution\Entity\User;
use InSided\Solution\Repository\CommunityRepositoryInterface;
use InSided\Solution\Request\Post\CreatePostCommand;
use InSided\Solution\Request\Post\DeletePostCommand;
use InSided\Solution\Request\Post\ListPostCommand;
use InSided\Solution\Request\Post\UpdatePostCommand;
use InSided\Solution\Utils\ErrorCode;
use InSided\Solution\Utils\Http;
use JsonSerializable;
use Psr\Log\LoggerInterface;

class PostService extends AbstractService
{
    public function __construct(LoggerInterface $logger, CommunityRepositoryInterface $communityRepository)
    {
        parent::__construct($logger, $communityRepository);
    }

    /**
     * @throws Exception
     */
    public function list(ListPostCommand $action): array
    {
        $community = $this->getCommunity($action->getCommunityId());

        return $community->listPosts($action->getType());
    }

    /**
     * @throws Exception
     */
    public function create(CreatePostCommand $action): JsonSerializable
    {
        $community = $this->getCommunity($action->getCommunityId());

        $class = $action->getType();
        $post = new $class(...$action->getData());

        return $community->savePost($post);
    }

    /**
     * @throws Exception
     */
    public function update(UpdatePostCommand $action): JsonSerializable
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
    public function delete(DeletePostCommand $action): JsonSerializable
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
    protected function hasRights(User $user, Post $post): bool
    {
        if ($post->getOwner()->getId() === $user->getId()) {
            return true;
        }

        $this->logger->error(ErrorCode::COMMENT_ACTION_NOT_AVAILABLE);
        throw new Exception(ErrorCode::COMMENT_ACTION_NOT_AVAILABLE, HTTP::HTTP_UNAUTHORIZED);
    }
}
