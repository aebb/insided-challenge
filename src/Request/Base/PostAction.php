<?php

namespace InSided\Solution\Request\Base;

use InSided\Solution\Entity\User;

abstract class PostAction extends AbstractAction
{
    public function __construct(User $user, string $communityId)
    {
       parent::__construct($user, $communityId);
    }
}
