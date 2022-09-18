<?php

namespace InSided\Solution\Service;

use InSided\Solution\Repository\CommunityRepositoryInterface;
use InSided\Solution\Request\Comments\CreateCommentAction;
use Psr\Log\LoggerInterface;

class CommentService extends AbstractService
{
    public function __construct(LoggerInterface $logger, protected readonly CommunityRepositoryInterface $communityRepository)
    {
        parent::__construct($logger);
    }

    public function createComment(CreateCommentAction $action): JsonSerializable
    {

    }
}
