<?php

namespace InSided\Solution\Service;

use Exception;
use InSided\Solution\Repository\CommunityRepositoryInterface;
use InSided\Solution\Request\Post\Article\EnableArticleAction;
use JsonSerializable;
use Psr\Log\LoggerInterface;

class ArticleService extends PostService
{
    public function __construct(LoggerInterface $logger, CommunityRepositoryInterface $communityRepository)
    {
        parent::__construct($logger, $communityRepository);
    }

    /**
     * @throws Exception
     */
    public function enableComments(EnableArticleAction $action): JsonSerializable
    {
        $user      = $action->getUser();
        $community = $this->getCommunity($action->getCommunityId());
        $article   = $this->getPost($community, $action->getPostId());

        $article->setData($action->getData());

        $this->communityRepository->save($community);

        return $article;
    }
}
