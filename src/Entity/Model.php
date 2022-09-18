<?php

namespace InSided\Solution\Entity;

use DateTime;
use JsonSerializable;

abstract class Model implements JsonSerializable
{
    private const KEY = 16;

    protected string $id;

    protected DateTime $createdAt;

    protected DateTime $updatedAt;

    public function __construct(string $id = null, DateTime $createdAt = null, DateTime $updatedAt = null)
    {
        $now = new DateTime();

        $this->id        = $id        ?? bin2hex(random_bytes(self::KEY));
        $this->createdAt = $createdAt ?? $now;
        $this->updatedAt = $updatedAt ?? $now;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setData(array $data): Model
    {
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}
