
<?php

namespace InSided\Solution\Request\Base;

use InSided\Solution\Entity\User;

abstract class AbstractAction
{
    public function __construct(
        protected  readonly User $user,
        protected  readonly string $communityId,
    ){}

    public function getUser(): User
    {
        return $this->user;
    }

    public function getCommunityId(): string
    {
        return $this->communityId;
    }


}
