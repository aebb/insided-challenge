<?php

namespace InSided\Solution\Request\Post\Article;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\GetPostAction;

class EnableArticleAction extends GetPostAction
{
    public function __construct(
        User $user,
        string $communityId,
        string $postId,
        private readonly bool $enableComments = false
    )
    {
        parent::__construct($user, $communityId, $postId);
    }

    public function getData(): array
    {
        return [
            'enableComments' => $this->enableComments
        ];
    }
}
