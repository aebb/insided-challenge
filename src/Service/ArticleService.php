<?php

namespace InSided\Solution\Service;

use Exception;
use InSided\Solution\Entity\Article;
use InSided\Solution\Entity\Community;
use InSided\Solution\Repository\CommunityRepositoryInterface;
use InSided\Solution\Request\Post\Article\EnableArticleCommand;
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
    public function enableComments(EnableArticleCommand $action): JsonSerializable
    {
        $user      = $action->getUser();
        $community = $this->getCommunity($action->getCommunityId());
        $article   = $this->getArticle($community, $action->getPostId());

        $this->hasRights($user, $article);

        $article->enableComments($action->getData());

        $this->communityRepository->save($community);

        return $article;
    }


    private function getArticle(Community $community, string $postId): ?Article
    {
        return parent::getPost($community, $postId);
    }
}
