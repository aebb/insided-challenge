<?php

namespace InSided\Solution\Request\Post\Article;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\UpdatePostAction;

class UpdateArticleAction extends UpdatePostAction
{
    public function __construct(
        User $user,
        string $communityId,
        string $postId,
        string $content,
        private readonly string $title
    )
    {
        parent::__construct($user, $communityId, $postId, $content);
    }

    public function getData(): array
    {
       return [
           'content' => $this->content,
           'title'   => $this->title,
       ];
    }
}
