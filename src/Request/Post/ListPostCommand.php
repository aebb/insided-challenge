<?php

namespace InSided\Solution\Request\Post;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Base\PostCommand;
use InSided\Solution\Request\Base\PostTypeTrait;

abstract class ListPostCommand extends PostCommand
{
    use PostTypeTrait;

    public function __construct(User $user, string $communityId)
    {
        parent::__construct($user, $communityId);
    }
}
