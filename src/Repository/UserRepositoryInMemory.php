<?php

namespace InSided\Solution\Repository;

use InSided\Solution\Entity\User;

class UserRepositoryInMemory extends AbstractArrayRepository implements UserRepositoryInterface
{
    private static array $container = [];
}
