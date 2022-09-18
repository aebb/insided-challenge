<?php

namespace InSided\Solution\Request\Post;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Base\PostAction;
use InSided\Solution\Request\Base\PostTypeTrait;

abstract class CreatePostAction extends PostAction
{
    use PostTypeTrait;

    public function __construct(
        User                      $user,
        string                    $communityId,
        protected readonly string $content
    )
    {
        parent::__construct($user, $communityId);
    }

    abstract function getData(): array;
}
