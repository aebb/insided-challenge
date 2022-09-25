<?php

namespace InSided\Solution\Repository;

use InSided\Solution\Entity\Community;

interface CommunityRepositoryInterface
{
    public function findCommunityById(string $id): ?Community;
    public function save(Community $entity): ?Community;
}
