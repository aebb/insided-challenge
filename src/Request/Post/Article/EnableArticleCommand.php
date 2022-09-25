<?php

namespace InSided\Solution\Request\Post\Article;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\GetPostCommand;

class EnableArticleCommand extends GetPostCommand
{
    public function __construct(
        User $user,
        string $communityId,
        string $postId,
        private readonly bool $enableComments = false
    ) {
        parent::__construct($user, $communityId, $postId);
    }

    public function getData(): bool
    {
        return $this->enableComments;
    }
}
