<?php

namespace InSided\Solution\Entity;

use DateTime;
use JsonSerializable;

class Model implements JsonSerializable
{
    private const KEY = 16;

    protected string $id;

    protected DateTime $createdAt;

    protected DateTime $updatedAt;

    public function __construct(string $id = null, DateTime $createdAt = null, DateTime $updatedAt = null)
    {
        $now = new DateTime();

        $this->id        = bin2hex(random_bytes(self::KEY));
        $this->createdAt = $createdAt ?? $now;
        $this->updatedAt = $updatedAt ?? $now;
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}