<?php

namespace InSided\Solution\Service;

use Exception;
use InSided\Solution\Entity\Comment;
use InSided\Solution\Repository\CommunityRepositoryInterface;
use InSided\Solution\Request\Comment\CreateCommentCommand;
use InSided\Solution\Utils\AppException;
use InSided\Solution\Utils\ErrorCode;
use InSided\Solution\Utils\Http;
use JsonSerializable;
use Psr\Log\LoggerInterface;

class CommentService extends AbstractService
{
    public function __construct(LoggerInterface $logger, CommunityRepositoryInterface $communityRepository)
    {
        parent::__construct($logger, $communityRepository);
    }

    /**
     * @throws Exception
     */
    public function createComment(CreateCommentCommand $action): JsonSerializable
    {
        $user      = $action->getUser();
        $community = $this->getCommunity($action->getCommunityId());
        $post      = $this->getPost($community, $action->getPostId());

        $comment = new Comment($action->getContent(), $user, $post);

        if (!$post->addComment($comment)) {
            $this->logger->error(ErrorCode::COMMENT_ACTION_NOT_AVAILABLE);
            throw new AppException(ErrorCode::COMMENT_ACTION_NOT_AVAILABLE, HTTP::HTTP_UNAUTHORIZED);
        }

        $this->communityRepository->save($community);

        return $comment;
    }
}
