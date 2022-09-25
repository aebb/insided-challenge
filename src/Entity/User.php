<?php

namespace InSided\Solution\Entity;

use DateTime;

class User extends Model
{
    private ?string $username;

    private array $roles;

    public function __construct(
        string $username = null,
        array $roles = [],
        string $id = null,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    ) {
        parent::__construct($id, $createdAt, $updatedAt);
        $this->username = $username;
        $this->roles = $roles;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function isModerator(): bool
    {
        return in_array(Roles::Moderator, $this->roles);
    }
}
