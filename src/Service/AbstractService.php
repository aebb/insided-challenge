<?php

namespace InSided\Solution\Service;

use Exception;
use InSided\Solution\Entity\Community;
use InSided\Solution\Entity\Post;
use InSided\Solution\Repository\CommunityRepositoryInterface;
use InSided\Solution\Utils\AppException;
use InSided\Solution\Utils\ErrorCode;
use InSided\Solution\Utils\Http;
use Psr\Log\LoggerInterface;

class AbstractService
{
    public function __construct(
        protected readonly LoggerInterface $logger,
        protected readonly CommunityRepositoryInterface $communityRepository
    ) {
    }

    /**
     * @throws Exception
     */
    protected function getCommunity(string $communityId): ?Community
    {
        $community = $this->communityRepository->findCommunityById($communityId);
        if (!$community) {
            $this->logger->error(ErrorCode::COMMUNITY_NOT_FOUND);
            throw new AppException(ErrorCode::COMMUNITY_NOT_FOUND, HTTP::HTTP_NOT_FOUND);
        }

        return $community;
    }

    /**
     * @throws Exception
     */
    protected function getPost(Community $community, string $postId): ?Post
    {
        $post = $community->fetchPost($postId);
        if (!$post) {
            $this->logger->error(ErrorCode::POST_NOT_FOUND);
            throw new AppException(ErrorCode::POST_NOT_FOUND, HTTP::HTTP_NOT_FOUND);
        }

        return $post;
    }
}
