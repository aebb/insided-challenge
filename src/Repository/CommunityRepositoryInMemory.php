<?php

namespace InSided\Solution\Repository;

use InSided\Solution\Entity\Community;

class CommunityRepositoryInMemory extends AbstractArrayRepository implements CommunityRepositoryInterface
{
    private static array $container = [];

    function getContainer(): array
    {
       return self::$container;
    }

    function findCommunityById(string $id): ?Community
    {
       return $this->findById($id);
    }

    function save(Community $community): Community
    {
        return $this->add($community);
    }
}
