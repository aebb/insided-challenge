<?php

namespace InSided\Solution\Request\Post;

use InSided\Solution\Entity\User;
use InSided\Solution\Request\Base\PostAction;
use InSided\Solution\Request\Base\PostTypeTrait;

abstract class ListPostAction extends PostAction
{
    use PostTypeTrait;

    public function __construct(User $user, string $communityId)
    {
        parent::__construct($user, $communityId);
    }
}
