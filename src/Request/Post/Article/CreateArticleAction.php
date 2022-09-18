<?php

namespace InSided\Solution\Request\Post\Article;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\CreatePostAction;

class CreateArticleAction extends CreatePostAction
{
    use ArticlePostTrait;

    public function __construct(
        User                    $user,
        string                  $communityId,
        string                  $content,
        private readonly string $title
    )
    {
        parent::__construct($user, $communityId, $content);
    }

    function getData(): array
    {
       return [
         'content' => $this->content,
         'title'   => $this->title,
       ];
    }
}
