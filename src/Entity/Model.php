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

    public function jsonSerialize(): array
    {
        $result = [];
        foreach (get_object_vars($this) as $name => $value) {
            if ($value instanceof JsonSerializable) {
                continue;
            }

            if ($value instanceof DateTime) {
                $result[$name] = $value->format('Y-m-d H:i:s');
            }

            if (null !== $value) {
                $result[$name] = $value;
            }
        }

        return $result;
    }
}
