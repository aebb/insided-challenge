<?php

namespace InSided\Solution\Repository;

use InSided\Solution\Entity\Community;

class CommunityRepositoryInMemory extends AbstractArrayRepository implements CommunityRepositoryInterface
{
    private static array $container = [];

    public function findCommunityById(string $id): ?Community
    {
        return self::$container[$id] ?? null;
    }

    public function save(Community $entity): ?Community
    {
        self::$container[$entity->getId()] = $entity;
        return $entity;
    }
}
