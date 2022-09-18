<?php

namespace InSided\Solution\Repository;

use InSided\Solution\Entity\Model;

abstract class AbstractArrayRepository
{
    abstract function getContainer(): array;

    function findById(string $id): Model {
        return $this->getContainer()[$id];
    }

    public function add(Model $model): ?Model
    {
        return $this->getContainer()[$model->getId()] = $model;
    }
}
