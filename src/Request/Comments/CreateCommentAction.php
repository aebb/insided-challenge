<?php

namespace InSided\Solution\Request\Comments;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Post\GetPostAction;

class CreateCommentAction extends GetPostAction
{
    public function __construct(User $user, string $communityId, string $postId, private readonly string $content)
    {
        parent::__construct($user, $communityId, $postId);
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
