<?php

namespace InSided\Solution\Request\Post;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Base\PostCommand;

abstract class UpdatePostCommand extends GetPostCommand
{
    public function __construct(
        User $user,
        string $communityId,
        string $postId,
        protected readonly string $content,
    )
    {
        parent::__construct($user, $communityId, $postId);
    }

    abstract function getData(): array;
}