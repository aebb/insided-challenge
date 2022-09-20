<?php

namespace InSided\Solution\Entity;

use DateTime;

class User extends Model
{
    private ?string $username;

    public function __construct(string $username = null, string $id = null, DateTime $createdAt = null, DateTime $updatedAt = null)
    {
        parent::__construct($id, $createdAt, $updatedAt);
        $this->username = $username;
    }
}
