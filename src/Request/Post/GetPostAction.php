<?php

namespace InSided\Solution\Request\Post;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Base\PostAction;

abstract class GetPostAction extends PostAction
{
    public function __construct(User $user, string $communityId, protected readonly string $postId)
    {
        parent::__construct($user, $communityId);
    }

    public function getPostId(): string
    {
        return $this->postId;
    }
}
