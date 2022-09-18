<?php

namespace InSided\Solution\Repository;

use InSided\Solution\Entity\Community;

interface CommunityRepositoryInterface
{
    function findCommunityById(string $id): ?Community;
    function save(Community $entity): ?Community;
}
